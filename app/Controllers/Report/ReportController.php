<?php

namespace App\Controllers\Report;

use App\Controllers\BaseController;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;

class ReportController extends BaseController
{
    protected $rentalModel;
    protected $rentalItemModel;

    public function __construct()
    {
        $this->rentalModel = new RentalModel();
        $this->rentalItemModel = new RentalItemModel();
    }

    public function index()
    {
        $rentals = $this->rentalModel->orderBy('created_at', 'DESC')->findAll();

        // Hitung total item per transaksi
        foreach ($rentals as &$rental) {
            $items = $this->rentalItemModel->where('rental_id', $rental['id'])->findAll();
            $rental['item_count'] = count($items);
        }

        return view('Admin/report/v_report', [
            'rentals' => $rentals
        ]);
    }
}
