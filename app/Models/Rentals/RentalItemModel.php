<?php

namespace App\Models\Rentals;

use CodeIgniter\Model;

class RentalItemModel extends Model
{
    protected $table = 'rental_items';
    protected $primaryKey = 'id';
    protected $allowedFields = 
    [
        'rental_id',
        'item_id',
        'borrow_date',
        'return_date',
        'quantity',
        'price'
    ];
    //protected $useTimestamps = true;

    /**
     * Fungsi untuk mendapatkan barang yang disewa berdasarkan transaksi
     */
    public function getItemsByRental($rentalId)
    {
        return $this->select('rental_items.*, items.name AS item_name, items.description')
                    ->join('items', 'items.id = rental_items.item_id')
                    ->where('rental_items.rental_id', $rentalId)
                    ->findAll();
    }
}
