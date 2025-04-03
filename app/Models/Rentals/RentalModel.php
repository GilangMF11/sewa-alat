<?php

namespace App\Models\Rentals;

use CodeIgniter\Model;

class RentalModel extends Model
{
    protected $table = 'rentals';
    protected $primaryKey = 'id';
    protected $allowedFields = 
    [
        'transaction_code', 
        'user_id', 
        'customer_name', 
        'total_price', 
        'address', 
        'shipping_cost', 
        'return_status', 
        'payment_status', 
        'payment_type', 
        'down_payment',
        'payment_due',
        'proof_of_payment', 
        'discount', 
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    //protected $createField = 'created_at';

    /**
     * Fungsi untuk mendapatkan transaksi berdasarkan pengguna
     */
    public function getRentalsByUser($userId)
    {
        return $this->where('id', $userId)->findAll();
    }

    /**
     * Fungsi untuk mendapatkan transaksi lengkap dengan detail barang
     */
    public function getRentalDetails($rentalId)
    {
        return $this->select('rentals.*, users.name AS user_name, users.email, users.phone')
                    ->join('users', 'users.id = rentals.user_id')
                    ->where('rentals.id', $rentalId)
                    ->first();
    }

    public function generateTransactionCode()
    {
        $today = date('dmy'); // contoh: 010425
        $todayFull = date('d-m-Y'); // untuk query by created_at

        // Ambil jumlah transaksi hari ini
        $todayCount = $this
            ->like('created_at', date('Y-m-d'))
            ->countAllResults();

        // Urutan hari ini + 1
        $newNumber = str_pad($todayCount + 1, 3, '0', STR_PAD_LEFT);

        // Format akhir
        return 'TRANS-' . date('dmY') . $newNumber;
    }


}
