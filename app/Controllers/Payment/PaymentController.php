<?php

namespace App\Controllers\Payment;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Rentals\RentalModel;


class PaymentController extends BaseController
{
    public function confirm()
    {
        $code = $this->request->getPost('transaction_code');
        $file = $this->request->getFile('proof_of_payment');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/payments', $newName);

            $rentalModel = new RentalModel();
            $rentalModel->where('transaction_code', $code)
                        ->set([
                            'proof_of_payment' => $newName,
                            'payment_status' => 1 // misal 1 = menunggu verifikasi
                        ])
                        ->update();

            return redirect()->to('/user/transactions')->with('success', 'Bukti pembayaran berhasil dikirim.');
        }

        return redirect()->back()->with('error', 'Upload bukti gagal. Pastikan file valid.');
    }
}
