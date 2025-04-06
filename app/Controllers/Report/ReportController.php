<?php

namespace App\Controllers\Report;

use App\Controllers\BaseController;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
        // Ambil parameter dari URL (GET)
        $status = $this->request->getGet('status');
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        // Mulai query
        $query = $this->rentalModel->orderBy('created_at', 'DESC');

        // Jika status diisi
        if (!empty($status)) {
            $query->where('return_status', $status);
        }

        // Jika bulan diisi
        if (!empty($bulan)) {
            $query->where('MONTH(created_at)', $bulan);
        }

        // Jika tahun diisi
        if (!empty($tahun)) {
            $query->where('YEAR(created_at)', $tahun);
        }

        // Eksekusi query
        $rentals = $query->findAll();

        // Hitung total item per transaksi
        foreach ($rentals as &$rental) {
            $items = $this->rentalItemModel
                        ->where('rental_id', $rental['id'])
                        ->findAll();
            $rental['item_count'] = count($items);
        }

        // Kirim ke view
        return view('Admin/report/v_report', [
            'rentals' => $rentals
        ]);
    }

    public function exportPdf()
    {
        // Ambil parameter filter dari URL
        $status = $this->request->getGet('status');
        $bulan  = $this->request->getGet('bulan');
        $tahun  = $this->request->getGet('tahun');

        // Query dasar
        $query = $this->rentalModel->orderBy('created_at', 'DESC');

        // Terapkan filter jika ada
        if (!is_null($status) && $status !== '') {
            $query->where('return_status', $status);
        }
        if (!empty($bulan)) {
            $query->where('MONTH(created_at)', $bulan);
        }
        if (!empty($tahun)) {
            $query->where('YEAR(created_at)', $tahun);
        }

        // Ambil data
        $rentals = $query->findAll();

        // Load tampilan view PDF
        $html = view('Admin/report/v_report_pdf', [
            'rentals' => $rentals
        ]);

        // Generate PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_transaksi_' . date('YmdHis') . '.pdf', ['Attachment' => false]);
    }

    public function exportExcel()
    {
        $status = $this->request->getGet('status');
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        $query = $this->rentalModel->orderBy('created_at', 'DESC');

        if (!empty($status)) {
            $query->where('return_status', $status);
        }
        if (!empty($bulan)) {
            $query->where('MONTH(created_at)', $bulan);
        }
        if (!empty($tahun)) {
            $query->where('YEAR(created_at)', $tahun);
        }

        $rentals = $query->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Transaksi');
        $sheet->setCellValue('C1', 'Nama Penyewa');
        $sheet->setCellValue('D1', 'Tanggal Pinjam');
        $sheet->setCellValue('E1', 'Total Harga');

        // Data
        $row = 2;
        $no = 1;
        foreach ($rentals as $rental) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $rental['transaction_code']);
            $sheet->setCellValue('C' . $row, $rental['customer_name']);
            $sheet->setCellValue('D' . $row, date('Y-m-d', strtotime($rental['created_at'])));
            $sheet->setCellValue('E' . $row, $rental['total_price']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        // Output file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan-sewa.xlsx"');
        $writer->save('php://output');
    }


}