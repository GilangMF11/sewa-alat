<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('landing/v_landing');
    }

    public function detailProduct(): string
    {
        return view('product/v_product_detail');
    }
}
