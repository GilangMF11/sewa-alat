<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\Rentals\RentalModel;
use App\Models\Users\UserModel;
use App\Models\Items\ItemModel;

class DashboardController extends BaseController
{
    protected $userModel;
    protected $itemModel;
    protected $rentalModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->itemModel = new ItemModel();
        $this->rentalModel = new RentalModel();
    }

    public function index()
    {
        $today = date('Y-m-d');

        // ✅ Ambil total pendapatan hari ini
        $todayRevenue = $this->rentalModel
            ->selectSum('total_price')
            ->where('DATE(created_at)', $today)
            ->get()
            ->getRow()
            ->total_price ?? 0;

        // ✅ Ambil jumlah transaksi hari ini
        $todayTransactionCount = $this->rentalModel
            ->where('DATE(created_at)', $today)
            ->countAllResults();

        // ✅ Ambil data pendapatan per bulan untuk grafik
        $monthlyRevenueRaw = $this->rentalModel
            ->select("MONTH(created_at) AS month, SUM(total_price) AS revenue")
            ->groupBy("MONTH(created_at)")
            ->orderBy("MONTH(created_at)", "ASC")
            ->findAll();

        $monthlyLabels = [];
        $monthlyData = [];

        foreach (range(1, 12) as $m) {
            $monthlyLabels[] = date('M', mktime(0, 0, 0, $m, 1));
            $found = array_filter($monthlyRevenueRaw, fn($row) => (int)$row['month'] === $m);
            $monthlyData[] = $found ? array_values($found)[0]['revenue'] : 0;
        }

        $chartData = json_encode([
            'labels' => $monthlyLabels,
            'data'   => $monthlyData
        ]);

        $data = [
            'users'        => $this->userModel->countAll(),
            'items'        => $this->itemModel->countAll(),
            'transactions' => $todayTransactionCount,
            'today_revenue'=> $todayRevenue,
            'chartData'    => $chartData
        ];

        return view('Admin/dashboard/v_dashboard', $data);
    }
}
