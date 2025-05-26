<?php

namespace App\Controllers\Checkout;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Carts\CartModel;
use App\Models\Carts\CartItemModel;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;

class CheckoutController extends BaseController
{
    protected $cartModel;
    protected $cartItemModel;
    protected $rentalModel;
    protected $rentalItemModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->cartItemModel = new CartItemModel();
        $this->rentalModel = new RentalModel();
        $this->rentalItemModel = new RentalItemModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $cartItems = $this->cartModel->getCartWithItems($userId);

        if (empty($cartItems)) {
            return redirect()->to('/user/cart')->with('error', 'Keranjang kosong.');
        }

        return view('Users/cart/v_user_cart_checkout', [
            'cartItems' => $cartItems
        ]);
    }

    // Proses checkout
    public function store()
    {
        $userId = session()->get('user_id');
        $customerName = $this->request->getPost('customer_name');
        $address = $this->request->getPost('address');
        $borrowDate = $this->request->getPost('borrow_date');
        $returnDate = $this->request->getPost('return_date');
        $paymentType = $this->request->getPost('payment_type');
        $duration = (int) $this->request->getPost('duration');
        $shippingCost = (int) $this->request->getPost('shipping_cost');

        // Validasi input
        if (!$customerName || !$address || !$borrowDate || !$returnDate || !$paymentType) {
            return redirect()->back()->with('error', 'Semua field wajib diisi.');
        }

        // Pastikan durasi minimal 1 hari
        if ($duration < 1) {
            $duration = 1;
        }

        // Validasi shipping cost
        $allowedShippingCosts = [0, 200000, 500000];
        if (!in_array($shippingCost, $allowedShippingCosts)) {
            return redirect()->back()->with('error', 'Jenis pengiriman tidak valid.');
        }

        // Ambil keranjang aktif
        $cart = $this->cartModel
            ->where('user_id', $userId)
            ->where('status', '1')
            ->first();

        if (!$cart) {
            return redirect()->to('/user/cart')->with('error', 'Keranjang kosong.');
        }

        // Ambil item dalam keranjang
        $cartItems = $this->cartItemModel
            ->where('cart_id', $cart['id'])
            ->findAll();

        if (empty($cartItems)) {
            return redirect()->to('/user/cart')->with('error', 'Tidak ada item dalam keranjang.');
        }

        // Hitung total harga berdasarkan durasi sewa
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'] * $duration;
        }

        // Total akhir = Total produk + Shipping cost
        $finalTotal = $totalPrice + $shippingCost;

        // Buat kode transaksi dan simpan ke rentals
        $transactionCode = $this->rentalModel->generateTransactionCode();
        $rentalId = $this->rentalModel->insert([
            'transaction_code' => $transactionCode,
            'user_id' => $userId,
            'customer_name' => $customerName,
            'total_price' => $finalTotal, // Total sudah termasuk shipping
            'address' => $address,
            'shipping_cost' => $shippingCost, // Simpan shipping cost terpisah
            'return_status' => 0,
            'payment_status' => 0,
            'payment_type' => $paymentType,
            'down_payment' => 0,
            'payment_due' => null,
            'discount' => 0,
        ]);

        // Simpan item-item ke rental_items
        foreach ($cartItems as $item) {
            $this->rentalItemModel->insert([
                'rental_id' => $rentalId,
                'item_id' => $item['item_id'],
                'borrow_date' => $borrowDate,
                'return_date' => $returnDate,
                'quantity' => $item['quantity'],
                'price' => $item['price'] * $duration // Harga sudah dikali durasi per item
            ]);
        }

        // Tandai keranjang sudah digunakan
        $this->cartModel->update($cart['id'], [
            'status' => '0'
        ]);

        // Log untuk debugging (opsional)
        log_message('info', 'Transaksi berhasil dibuat: ' . $transactionCode . ' dengan total: ' . $finalTotal);

        // Ambil data untuk ditampilkan di halaman sukses
        $transactionData = $this->rentalModel->find($rentalId);

        return view('Users/cart/v_user_cart_checkout_success', [
            'transaction' => $transactionData
        ]);
    }

}
