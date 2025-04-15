<?php

namespace App\Controllers\Transaction;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Items\ItemModel;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;
use App\Models\Users\UserModel;

class TransactionController extends BaseController
{
    protected $rentalModel;
    protected $rentalItemModel;
    protected $userModel;
    protected $itemModel;

    public function __construct()
    {
        $this->rentalModel = new RentalModel();
        $this->rentalItemModel = new RentalItemModel();
        $this->userModel = new UserModel();
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data = [
            'products' => $this->itemModel->orderBy('name', 'asc')->findAll(),
            'users' => $this->userModel->findAll(),
        ];
        
        return view('Admin/transaction/v_transaction', $data);
    }

    public function store()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $db = \Config\Database::connect();

        $validation->setRules([
            'borrow_date' => 'required',
            'return_date' => 'required',
            'shipping_cost' => 'required|numeric',
            'payment_type' => 'required',
            'total_price' => 'required|numeric',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $customerName = $request->getPost('customer_name');
        $transaction_code = $this->rentalModel->generateTransactionCode();
        $proof_of_payment = $request->getFile('proof_of_payment');

        if ($proof_of_payment && $proof_of_payment->isValid()) {
            $newProof = $proof_of_payment->getRandomName();
            $proof_of_payment->move(WRITEPATH . 'uploads/payments', $newProof);
        }

        // Discount
        $discount = $request->getPost('discount');
        $totalPrice = $request->getPost('total_price');
        $shippingCost = $request->getPost('shipping_cost');
        // Total akhir = harga semua barang + biaya kirim - diskon
        $discountedPrice = ($totalPrice + $shippingCost) - $discount;


        $rentalData = [
            'transaction_code' => $transaction_code,
            'user_id' => $request->getPost('user_id') ?? null,
            'customer_name' => $customerName,
            'total_price' => $discountedPrice ?? 0,
            'address' => $request->getPost('address') ?? '',
            'shipping_cost' => $shippingCost,
            'return_status' => $request->getPost('return_status') ?? 0,
            'payment_status' => $request->getPost('payment_status') ?? 0,
            'payment_type' => $request->getPost('payment_type') ?? 0,
            'down_payment' => $request->getPost('down_payment') ?? null,
            'payment_due' => $request->getPost('payment_due') ?? null,
            'proof_of_payment' => $proof_of_payment ? $newProof : null,
            'discount' => $discount,
        ];

        $items = $request->getPost('items');

        // ✅ Pastikan items tidak kosong
        if (!$items || !is_array($items) || count($items) == 0) {
            return redirect()->back()->withInput()->with('errors', 'Barang sewaan tidak boleh kosong!');
        }

        // ✅ Mulai transaksi DB
        $db->transStart();

        $rentalId = $this->rentalModel->insert($rentalData, true); // true untuk return insert ID

        if (!$rentalId) {
            return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan transaksi.');
        }
        
        foreach ($items as $item) {
            if (!isset($item['item_id']) || !$item['item_id']) continue;

            $this->rentalItemModel->insert([
                'rental_id' => $rentalId,
                'item_id' => $item['item_id'],
                'borrow_date' => $request->getPost('borrow_date'),
                'return_date' => $request->getPost('return_date'),
                'quantity' => $item['quantity'],
                'price' => str_replace('.', '', $item['price']),
            ]);

            // 🔻 Kurangi stok produk
            $product = $this->itemModel->find($item['item_id']);
            if ($product) {
                $newStock = max(0, $product['stock'] - $item['quantity']); // Hindari negatif
                $this->itemModel->update($item['item_id'], ['stock' => $newStock]);
            }
            
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan transaksi.');
        }

        return redirect()->to(base_url('order'))->with('success', 'Transaksi berhasil disimpan');
    }


}