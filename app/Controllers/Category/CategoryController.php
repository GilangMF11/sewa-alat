<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    public function index()
    {
        return view('Admin/category/v_category');
    }
}
