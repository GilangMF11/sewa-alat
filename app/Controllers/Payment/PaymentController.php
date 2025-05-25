<?php

namespace App\Controllers\Payment;

use App\Controllers\BaseController;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;
use App\Models\Items\ItemModel;

class PaymentController extends BaseController
{
    protected $rentalModel;

    public function __construct()
    {
        $this->rentalModel = new RentalModel();
    }

    public function confirm()
    {
        $code = $this->request->getPost('transaction_code'); // Kode transaksi yang dimasukkan
        $file = $this->request->getFile('proof_of_payment');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/payments', $newName);

            // Update status pembayaran dan simpan bukti pembayaran
            $rentalModel = new RentalModel();
            $rentalModel->where('transaction_code', $code)
                        ->set([
                            'proof_of_payment' => $newName,
                            'payment_status' => 2 // Menunggu verifikasi
                        ])
                        ->update();

            // Kurangi stok dari rental item
            $rentalItemModel = new RentalItemModel();
            
            // Cari rental items berdasarkan rental_id, bukan transaction_code
            $rental = $rentalModel->where('transaction_code', $code)->first();
            if ($rental) {
                $rentalItems = $rentalItemModel->where('rental_id', $rental['id'])->findAll();
                
                foreach ($rentalItems as $rentalItem) {
                    // Ambil data item berdasarkan item_id
                    $itemModel = new ItemModel();
                    $item = $itemModel->find($rentalItem['item_id']);
                    
                    if ($item) {
                        // Kurangi stok produk berdasarkan jumlah yang disewa
                        $newStock = $item['stock'] - $rentalItem['quantity'];
                        
                        // Pastikan stok tidak kurang dari 0
                        if ($newStock >= 0) {
                            $itemModel->where('id', $rentalItem['item_id'])
                                      ->set('stock', $newStock)
                                      ->update();
                        } else {
                            // Jika stok kurang, beri pesan error atau handle sesuai kebijakan
                            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
                        }
                    }
                }
            }

            return redirect()->to('/user/transactions')->with('success', 'Bukti pembayaran berhasil dikirim.');
        }

        return redirect()->back()->with('error', 'Upload bukti gagal. Pastikan file valid.');
    }

        /**
     * Show upload bukti pembayaran page
     */
    public function uploadProof($transactionCode = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $userId = session()->get('user_id');

        // Get transaction by code and user_id untuk security
        $transaction = $this->rentalModel
            ->where('transaction_code', $transactionCode)
            ->where('user_id', $userId)
            ->first();

        // If transaction not found or not belongs to user
        if (!$transaction) {
            return redirect()->to('user/transactions')
                ->with('error', 'Transaksi tidak ditemukan atau Anda tidak memiliki akses');
        }

        // If already paid
        if ($transaction['payment_status'] == 1) {
            return redirect()->to('user/transactions')
                ->with('info', 'Transaksi ini sudah lunas');
        }

        return view('Users/transactions/v_user_transactions_upload', [
            'transaction' => $transaction
        ]);
    }
}
