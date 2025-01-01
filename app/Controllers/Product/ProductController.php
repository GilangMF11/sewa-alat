<?php

namespace App\Controllers\Product;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function index()
    {
        return view('Admin/product/v_product');
    }
}
