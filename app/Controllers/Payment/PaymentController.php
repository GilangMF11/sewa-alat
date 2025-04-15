<?php

namespace App\Controllers\Payment;

use App\Controllers\BaseController;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;
use App\Models\Items\ItemModel;

class PaymentController extends BaseController
{
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
}
