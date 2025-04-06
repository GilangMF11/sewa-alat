<?php

namespace App\Models\Carts;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table            = 'cartitems';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['cart_id', 'item_id', 'quantity', 'price', 'created_at', 'updated_at'];
    protected $useTimestamps    = true;

    public function getItemsByCart($cartId)
    {
        return $this->where('cart_id', $cartId)->findAll();
    }

    public function getTotalPriceByCart($cartId)
    {
        return $this->selectSum('price')->where('cart_id', $cartId)->first();
    }
}
