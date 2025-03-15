<?php

namespace App\Controllers\Transaction;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Items\ItemModel;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;
use App\Models\Users\UserModel;

class TransactionController extends BaseController
{
    protected $rentalModel;
    protected $rentalItemModel;
    protected $userModel;
    protected $itemModel;

    public function __construct()
    {
        $this->rentalModel = new RentalModel();
        $this->rentalItemModel = new RentalItemModel();
        $this->userModel = new UserModel();
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data = [
            'products' => $this->itemModel->orderBy('name', 'asc')->findAll(),
            'users' => $this->userModel->findAll(),
        ];
        
        return view('Admin/transaction/v_transaction', $data);
    }

    public function store()
    {
        
    }
}
