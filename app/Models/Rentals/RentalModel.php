<?php

namespace App\Models\Rentals;

use CodeIgniter\Model;

class RentalModel extends Model
{
    protected $table = 'rentals';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'total_price', 'shipping_cost', 'return_status', 'payment_status', 'discount', 'created_at'];
    protected $useTimestamps = true;

    /**
     * Fungsi untuk mendapatkan transaksi berdasarkan pengguna
     */
    public function getRentalsByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
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
}
