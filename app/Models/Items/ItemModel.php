<?php

namespace App\Models\Items;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'price', 'stock', 'category_id', 'image', 'created_at'];
    protected $createdField  = 'created_at';

    /**
     * Fungsi untuk mendapatkan barang beserta kategori
     */
    public function getItemsWithCategory()
    {
        return $this->select('items.*, categories.name AS category_name')
                    ->join('categories', 'categories.id = items.category_id', 'left')
                    ->findAll();
    }
}
