<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\Rentals\RentalModel;
use App\Models\Users\UserModel;
use App\Models\Items\ItemModel;
use App\Models\Categories\CategoryModel;

class DashboardController extends BaseController
{
    protected $userModel;
    protected $itemModel;
    protected $rentalModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->itemModel = new ItemModel();
        $this->rentalModel = new RentalModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userRole = session()->get('role');
        $userId = session()->get('user_id');

        if ($userRole === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard($userId);
        }
    }

    /**
     * Admin Dashboard
     */
    private function adminDashboard()
    {
        $today = date('Y-m-d');

        // Total pendapatan hari ini
        $todayRevenue = $this->rentalModel
            ->selectSum('total_price')
            ->where('DATE(created_at)', $today)
            ->get()
            ->getRow()
            ->total_price ?? 0;

        // Jumlah transaksi hari ini
        $todayTransactionCount = $this->rentalModel
            ->where('DATE(created_at)', $today)
            ->countAllResults();

        // Data pendapatan per bulan untuk grafik
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

        // Statistik tambahan untuk admin
        $totalUsers = $this->userModel->where('role', 'user')->countAllResults();
        $totalItems = $this->itemModel->countAll();
        $totalCategories = $this->categoryModel->countAll();
        
        // Items dengan stok rendah (< 5)
        $lowStockItems = $this->itemModel->where('stock <', 5)->countAllResults();
        
        // Transaksi pending payment
        $pendingPayments = $this->rentalModel->where('payment_status', 0)->countAllResults();
        
        // Items yang belum dikembalikan
        $pendingReturns = $this->rentalModel->where('return_status', 0)->countAllResults();

        // Top 5 items yang paling sering disewa
        $topRentedItems = $this->rentalModel
            ->select('items.name, COUNT(rental_items.item_id) as rental_count')
            ->join('rental_items', 'rental_items.rental_id = rentals.id')
            ->join('items', 'items.id = rental_items.item_id')
            ->groupBy('rental_items.item_id')
            ->orderBy('rental_count', 'DESC')
            ->limit(5)
            ->findAll();

        // Recent transactions (5 latest)
        $recentTransactions = $this->rentalModel
            ->select('transaction_code, customer_name, total_price, created_at, payment_status, return_status')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $chartData = json_encode([
            'labels' => $monthlyLabels,
            'data'   => $monthlyData
        ]);

        $data = [
            'users'              => $totalUsers,
            'items'              => $totalItems,
            'categories'         => $totalCategories,
            'transactions'       => $todayTransactionCount,
            'today_revenue'      => $todayRevenue,
            'low_stock_items'    => $lowStockItems,
            'pending_payments'   => $pendingPayments,
            'pending_returns'    => $pendingReturns,
            'top_rented_items'   => $topRentedItems,
            'recent_transactions'=> $recentTransactions,
            'chartData'          => $chartData
        ];

        return view('Admin/dashboard/v_dashboard', $data);
    }

    /**
     * User Dashboard
     */
    private function userDashboard($userId)
    {
        // Statistik user
        $userRentals = $this->rentalModel->where('user_id', $userId)->countAllResults();
        
        // Total yang pernah dibayar user
        $totalSpent = $this->rentalModel
            ->selectSum('total_price')
            ->where('user_id', $userId)
            ->where('payment_status', 1)
            ->get()
            ->getRow()
            ->total_price ?? 0;

        // Rental aktif (belum dikembalikan)
        $activeRentals = $this->rentalModel
            ->where('user_id', $userId)
            ->where('return_status', 0)
            ->countAllResults();

        // Rental yang butuh pembayaran
        $pendingPayments = $this->rentalModel
            ->where('user_id', $userId)
            ->where('payment_status', 0)
            ->countAllResults();

        // Riwayat rental user (10 terbaru)
        $rentalHistory = $this->rentalModel
            ->select('rentals.*, GROUP_CONCAT(items.name SEPARATOR ", ") as item_names')
            ->join('rental_items', 'rental_items.rental_id = rentals.id')
            ->join('items', 'items.id = rental_items.item_id')
            ->where('rentals.user_id', $userId)
            ->groupBy('rentals.id')
            ->orderBy('rentals.created_at', 'DESC')
            ->limit(10)
            ->findAll();

        // Items favorit user (yang paling sering disewa)
        $favoriteItems = $this->rentalModel
            ->select('items.name, items.image, COUNT(rental_items.item_id) as rental_count')
            ->join('rental_items', 'rental_items.rental_id = rentals.id')
            ->join('items', 'items.id = rental_items.item_id')
            ->where('rentals.user_id', $userId)
            ->groupBy('rental_items.item_id')
            ->orderBy('rental_count', 'DESC')
            ->limit(5)
            ->findAll();

        // Items yang tersedia untuk disewa (stok > 0)
        $availableItems = $this->itemModel
            ->select('items.*, categories.name as category_name')
            ->join('categories', 'categories.id = items.category_id', 'left')
            ->where('items.stock >', 0)
            ->orderBy('items.created_at', 'DESC')
            ->limit(8)
            ->findAll();

        // Rental per bulan untuk grafik user (hanya milik user ini)
        $monthlyRentalsRaw = $this->rentalModel
            ->select("MONTH(created_at) AS month, COUNT(*) AS rental_count")
            ->where('user_id', $userId)
            ->groupBy("MONTH(created_at)")
            ->orderBy("MONTH(created_at)", "ASC")
            ->findAll();

        $monthlyLabels = [];
        $monthlyData = [];

        foreach (range(1, 12) as $m) {
            $monthlyLabels[] = date('M', mktime(0, 0, 0, $m, 1));
            $found = array_filter($monthlyRentalsRaw, fn($row) => (int)$row['month'] === $m);
            $monthlyData[] = $found ? array_values($found)[0]['rental_count'] : 0;
        }

        $chartData = json_encode([
            'labels' => $monthlyLabels,
            'data'   => $monthlyData
        ]);

        $data = [
            'user_rentals'     => $userRentals,
            'total_spent'      => $totalSpent,
            'active_rentals'   => $activeRentals,
            'pending_payments' => $pendingPayments,
            'rental_history'   => $rentalHistory,
            'favorite_items'   => $favoriteItems,
            'available_items'  => $availableItems,
            'chartData'        => $chartData
        ];

        return view('Users/dashboard/v_user_dashboard', $data);
    }
}