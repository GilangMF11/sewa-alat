<?php

namespace App\Controllers\Setting;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SettingController extends BaseController
{
    public function index()
    {
        return view('Admin/setting/v_setting');
    }
}
