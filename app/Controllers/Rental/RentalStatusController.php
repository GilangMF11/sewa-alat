<?php

namespace App\Controllers\Rental;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;
use App\Models\Settings\SettingModel;

class RentalStatusController extends BaseController
{
    protected $rentalModel;
    protected $rentalItemModel;
    protected $setting;

    public function __construct()
    {
        $this->rentalModel = new RentalModel();
        $this->rentalItemModel = new RentalItemModel();
        $this->setting = new SettingModel();
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
                        ->select('rental_items.*, items.name AS item_name, items.description AS item_description') // Mendapatkan nama barang dari tabel items
                        ->join('items', 'items.id = rental_items.item_id')
                        ->where('rental_items.rental_id', $rental['id'])
                        ->findAll();
                        
            $rental['item_count'] = count($items);
            $rental['items'] = $items; // Menambahkan data items ke dalam rental
            $rentalDetails[] = $rental;
        }

        // Kirim data ke view
        return view('Admin/rental-status/v_rental_status', [
            'rentals' => $rentalDetails // Mengirimkan data rental beserta items
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
    
        // Pastikan ID valid dan tidak kosong
        if (!$id) {
            return redirect()->back()->with('errors', 'ID transaksi tidak valid');
        }
    
        // Melakukan update pada rental berdasarkan ID yang valid
        $updateData = [
            'payment_status' => $payment_status,
            'return_status' => $return_status
        ];
    
        // Memastikan bahwa update dilakukan pada data yang valid
        $result = $this->rentalModel->update($id, $updateData);
    
        // Cek apakah update berhasil
        if ($result === false) {
            return redirect()->back()->with('errors', 'Gagal memperbarui status');
        }
    
        return redirect()->to('/report')->with('success', 'Status berhasil diperbarui.');
    }
    
    public function print($id)
    {
        $settings = $this->setting;
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
    }


}