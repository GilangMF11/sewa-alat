<?php

namespace App\Controllers\Transaction;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TransactionController extends BaseController
{
    public function index()
    {
        return view('Admin/transaction/v_transaction');
    }
}
