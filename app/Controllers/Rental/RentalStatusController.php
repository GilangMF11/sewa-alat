<?php

namespace App\Controllers\Rental;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;
use App\Models\Settings\SettingModel;
use App\Models\Items\ItemModel;

class RentalStatusController extends BaseController
{
    protected $rentalModel;
    protected $rentalItemModel;
    protected $settingModel;
    protected $itemModel;

    public function __construct()
    {
        $this->rentalModel = new RentalModel();
        $this->rentalItemModel = new RentalItemModel();
        $this->settingModel = new SettingModel();
        $this->itemModel = new ItemModel();
    }

    /**
     * Get application settings safely
     */
    private function getSettings()
    {
        try {
            $settings = $this->settingModel->first();
            
            if (!$settings) {
                // Return default settings if no settings found
                return [
                    'name_web' => 'Ngesti Gongso Kemojing',
                    'phone' => '081234567892',
                    'logo' => 'default-logo.png'
                ];
            }
            
            // Convert object to array for consistent access
            return is_object($settings) ? (array) $settings : $settings;
            
        } catch (\Exception $e) {
            log_message('error', 'Settings Error: ' . $e->getMessage());
            
            // Return default settings on error
            return [
                'name_web' => 'Ngesti Gongso Kemojing',
                'phone' => '081234567892',
                'logo' => 'default-logo.png'
            ];
        }
    }

    public function index()
    {
        $status = $this->request->getGet('status');
        $bulan  = $this->request->getGet('bulan');
        $tahun  = $this->request->getGet('tahun');

        // Mulai query untuk mengambil data sewa
        $query = $this->rentalModel->orderBy('created_at', 'DESC');

        // Filter berdasarkan status, bulan, atau tahun jika parameter ada
        if ($status !== null && $status !== '') {
            $query->where('return_status', $status);
        }

        if ($bulan) {
            $query->where('MONTH(created_at)', $bulan);
        }

        if ($tahun) {
            $query->where('YEAR(created_at)', $tahun);
        }

        // Ambil hasil query
        $rentals = $query->findAll();

        // Siapkan data tambahan untuk view
        $rentalDetails = [];

        // Hitung total item per transaksi dan ambil detail item
        foreach ($rentals as $rental) {
            $items = $this->rentalItemModel
                        ->select('rental_items.*, items.name AS item_name, items.description AS item_description')
                        ->join('items', 'items.id = rental_items.item_id')
                        ->where('rental_items.rental_id', $rental['id'])
                        ->findAll();
                        
            $rental['item_count'] = count($items);
            $rental['items'] = $items;
            $rentalDetails[] = $rental;
        }

        // Kirim data ke view
        return view('Admin/rental-status/v_rental_status', [
            'rentals' => $rentalDetails
        ]);
    }

    public function detail($id)
    {
        // Mengambil data transaksi
        $rental = $this->rentalModel->find($id);
        // Mengambil detail item barang yang terkait dengan transaksi
        $items = $this->rentalItemModel->getItemsByRental($id);

        // Menggabungkan semua data yang diperlukan untuk modal
        return view('Admin/rental-status/modal_detail', [
            'rental' => $rental,
            'items' => $items
        ]);
    }

    public function updateStatus()
    {
        // Mengambil data yang dikirim dari form
        $id = $this->request->getPost('id');
        $payment_status = $this->request->getPost('payment_status');
        $return_status = $this->request->getPost('return_status');
        $shipping_cost = $this->request->getPost('shipping_cost');
        $proof_of_payment = $this->request->getFile('proof_of_payment');
        $total_price = $this->request->getPost('total_price');

        // Handle file upload
        $newProof = null;
        if ($proof_of_payment && $proof_of_payment->isValid()) {
            $uploadPath = WRITEPATH . 'uploads/payments/';
            
            // Create directory if not exists
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $newProof = $proof_of_payment->getRandomName();
            $proof_of_payment->move($uploadPath, $newProof);
        }

        // Pastikan ID valid dan tidak kosong
        if (!$id) {
            return redirect()->back()->with('errors', 'ID transaksi tidak valid');
        }

        // Get current rental data to check previous status
        $currentRental = $this->rentalModel->find($id);
        if (!$currentRental) {
            return redirect()->back()->with('errors', 'Transaksi tidak ditemukan');
        }

        // Melakukan update pada rental berdasarkan ID yang valid
        $updateData = [
            'payment_status' => $payment_status,
            'return_status' => $return_status,
            'shipping_cost' => $shipping_cost,
            'total_price' => $total_price,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Only update proof_of_payment if a new file was uploaded
        if ($newProof) {
            $updateData['proof_of_payment'] = $newProof;
        }

        // Memastikan bahwa update dilakukan pada data yang valid
        $result = $this->rentalModel->update($id, $updateData);

        // Cek apakah update berhasil
        if ($result === false) {
            return redirect()->back()->with('errors', 'Gagal memperbarui status');
        }

        // Update stok barang kalau return_status berubah menjadi 1 (dikembalikan)
        if ($return_status == 1 && $currentRental['return_status'] == 0) {
            $this->updateItemStock($id, 'return');
        }
        // Jika status dikembalikan dari 1 ke 0 (dibatalkan), kurangi stok lagi
        elseif ($return_status == 0 && $currentRental['return_status'] == 1) {
            $this->updateItemStock($id, 'borrow');
        }

        return redirect()->to('/rental-status')->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Update item stock based on action
     */
    private function updateItemStock($rentalId, $action = 'return')
    {
        try {
            $rentalItems = $this->rentalItemModel
                            ->where('rental_id', $rentalId)
                            ->findAll();

            foreach ($rentalItems as $item) {
                if ($action === 'return') {
                    // Kembalikan stok (tambah)
                    $this->itemModel->where('id', $item['item_id'])
                                   ->increment('stock', (int) $item['quantity']);
                } else {
                    // Kurangi stok (saat diborrow lagi)
                    $currentItem = $this->itemModel->find($item['item_id']);
                    if ($currentItem && $currentItem['stock'] >= $item['quantity']) {
                        $this->itemModel->where('id', $item['item_id'])
                                       ->decrement('stock', (int) $item['quantity']);
                    }
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Stock Update Error: ' . $e->getMessage());
        }
    }

    /**
     * Print thermal receipt
     */
    public function print($id)
    {
        try {
            // Get settings data safely
            $settings = $this->getSettings();
            
            $rental = $this->rentalModel->find($id);
            $items = $this->rentalItemModel
                        ->select('rental_items.*, items.name as item_name')
                        ->join('items', 'items.id = rental_items.item_id')
                        ->where('rental_items.rental_id', $id)
                        ->findAll();

            if (!$rental) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan.');
            }

            return view('Admin/rental-status/v_rental_print_struk', [
                'rental' => $rental,
                'items' => $items,
                'setting' => $settings
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Print Receipt Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mencetak struk: ' . $e->getMessage());
        }
    }

    /**
     * Download receipt as PDF
     */
    public function downloadPDF($id)
    {
        // You can implement PDF generation here using libraries like TCPDF or mPDF
        // For now, we'll redirect to print version
        return redirect()->to("/rental-status/print/{$id}");
    }

    /**
     * Bulk update status
     */
    public function bulkUpdate()
    {
        $selectedIds = $this->request->getPost('selected_ids');
        $action = $this->request->getPost('bulk_action');
        
        if (empty($selectedIds) || empty($action)) {
            return redirect()->back()->with('errors', 'Pilih data dan aksi yang ingin dilakukan');
        }

        $updateData = [];
        $message = '';

        switch ($action) {
            case 'mark_paid':
                $updateData['payment_status'] = 1;
                $message = 'Status pembayaran berhasil diubah menjadi lunas';
                break;
            case 'mark_unpaid':
                $updateData['payment_status'] = 0;
                $message = 'Status pembayaran berhasil diubah menjadi belum lunas';
                break;
            case 'mark_returned':
                $updateData['return_status'] = 1;
                $message = 'Status pengembalian berhasil diubah menjadi sudah dikembalikan';
                // Update stock for all selected items
                foreach ($selectedIds as $id) {
                    $current = $this->rentalModel->find($id);
                    if ($current && $current['return_status'] == 0) {
                        $this->updateItemStock($id, 'return');
                    }
                }
                break;
            case 'mark_not_returned':
                $updateData['return_status'] = 0;
                $message = 'Status pengembalian berhasil diubah menjadi belum dikembalikan';
                // Update stock for all selected items
                foreach ($selectedIds as $id) {
                    $current = $this->rentalModel->find($id);
                    if ($current && $current['return_status'] == 1) {
                        $this->updateItemStock($id, 'borrow');
                    }
                }
                break;
            default:
                return redirect()->back()->with('errors', 'Aksi tidak valid');
        }

        if (!empty($updateData)) {
            $updateData['updated_at'] = date('Y-m-d H:i:s');
            $this->rentalModel->whereIn('id', $selectedIds)->set($updateData)->update();
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Get rental statistics
     */
    public function getStats()
    {
        try {
            $totalRentals = $this->rentalModel->countAll();
            $paidRentals = $this->rentalModel->where('payment_status', 1)->countAllResults();
            $unpaidRentals = $this->rentalModel->where('payment_status', 0)->countAllResults();
            $returnedRentals = $this->rentalModel->where('return_status', 1)->countAllResults();
            $notReturnedRentals = $this->rentalModel->where('return_status', 0)->countAllResults();
            
            $totalRevenue = $this->rentalModel
                                ->selectSum('total_price')
                                ->where('payment_status', 1)
                                ->get()
                                ->getRow()
                                ->total_price ?? 0;

            return $this->response->setJSON([
                'status' => 'success',
                'data' => [
                    'total_rentals' => $totalRentals,
                    'paid_rentals' => $paidRentals,
                    'unpaid_rentals' => $unpaidRentals,
                    'returned_rentals' => $returnedRentals,
                    'not_returned_rentals' => $notReturnedRentals,
                    'total_revenue' => $totalRevenue
                ]
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Stats Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengambil statistik'
            ]);
        }
    }

    /**
     * Export data to Excel/CSV
     */
    public function export($format = 'csv')
    {
        try {
            $rentals = $this->rentalModel
                           ->select('rentals.*, GROUP_CONCAT(items.name SEPARATOR ", ") as item_names')
                           ->join('rental_items', 'rental_items.rental_id = rentals.id')
                           ->join('items', 'items.id = rental_items.item_id')
                           ->groupBy('rentals.id')
                           ->orderBy('rentals.created_at', 'DESC')
                           ->findAll();

            if ($format === 'csv') {
                return $this->exportCSV($rentals);
            } else {
                return $this->exportExcel($rentals);
            }
        } catch (\Exception $e) {
            log_message('error', 'Export Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengekspor data');
        }
    }

    private function exportCSV($data)
    {
        $filename = 'rental_data_' . date('Y-m-d_H-i-s') . '.csv';
        
        // Set headers for file download
        $this->response->setHeader('Content-Type', 'text/csv');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        
        // Create CSV content
        $csvData = [];
        
        // Header CSV
        $csvData[] = [
            'Kode Transaksi',
            'Customer',
            'Items',
            'Total',
            'Status Pembayaran',
            'Status Pengembalian',
            'Tanggal'
        ];
        
        // Data CSV
        foreach ($data as $row) {
            $csvData[] = [
                $row['transaction_code'],
                $row['customer_name'],
                $row['item_names'],
                $row['total_price'],
                $row['payment_status'] == 1 ? 'Lunas' : 'Belum Lunas',
                $row['return_status'] == 1 ? 'Sudah Kembali' : 'Belum Kembali',
                date('d/m/Y H:i', strtotime($row['created_at']))
            ];
        }
        
        // Convert to CSV string
        $csvContent = '';
        foreach ($csvData as $row) {
            $csvContent .= '"' . implode('","', $row) . '"' . "\n";
        }
        
        return $this->response->setBody($csvContent);
    }

    private function exportExcel($data)
    {
        // Implement Excel export using PhpSpreadsheet or similar library
        // For now, fallback to CSV
        return $this->exportCSV($data);
    }
}