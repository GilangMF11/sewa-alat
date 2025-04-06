<?php

namespace App\Models\Carts;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table            = 'carts';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['user_id', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getCartWithItems($userId)
    {
        return $this->select('carts.*, cart_items.*, items.name, items.price')
                    ->join('cart_items', 'cart_items.cart_id = carts.id')
                    ->join('items', 'items.id = cart_items.item_id')
                    ->where('carts.user_id', $userId)
                    ->where('carts.status', 'active')
                    ->findAll();
    }

}
