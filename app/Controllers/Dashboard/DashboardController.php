<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users\UserModel;
use App\Models\Items\ItemModel;

class DashboardController extends BaseController
{
    protected $userModel;
    protected $itemModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->itemModel = new ItemModel();

        
    }
    public function index()
    {
        $data = [
            'users' => $this->userModel->countAll(),
            'items' => $this->itemModel->countAll()
        ];

        return view('Admin/dashboard/v_dashboard', $data);
    }
}
