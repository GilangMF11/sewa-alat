<?php

namespace App\Controllers\Report;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReportController extends BaseController
{
    public function index()
    {
        return view('Admin/report/v_report');
    }
}
