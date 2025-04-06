<?php

namespace App\Controllers\Cart;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CartController extends BaseController
{
    public function index()
    {
        return view('Users/cart/v_user_cart');
    }
}
