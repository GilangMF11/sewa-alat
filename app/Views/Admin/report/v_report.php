<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Card with custom background color on the header -->
            <div class="card border-primary">
                <div class="card-header custom-header-bg">
                    <h3 class="card-title font-weight-bold">Laporan Transaksi Sewa Barang</h3>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <select class="form-control" id="filterTahun">
                                <option value="">Pilih Status</option>
                                <option value="2025">Sudah DiKembalikan</option>
                                <option value="2025">Belum DiKembalikan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="filterBulan">
                                <option value="">Pilih Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="filterTahun">
                                <option value="">Pilih Tahun</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" id="filterBtn">Cari</button>
                        </div>
                        <!-- Export Button -->
                        <div class="col-md-2 ml-auto text-right">
                            <button class="btn btn-danger" id="exportPdfBtn">PDF</button>
                            <button class="btn btn-success" id="exportExcelBtn">Excel</button>
                        </div>
                    </div>
                    <!-- Filter Form End -->

                    <!-- Table -->
                    <table class="table table-bordered table-striped table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Nama Penyewa</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status Sewa</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($rentals as $rental): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($rental['transaction_code']) ?></td>
                                <td><?= esc($rental['customer_name']) ?></td>
                                <td><?= esc(date('Y-m-d', strtotime($rental['created_at']))) ?></td>
                                <td>
                                    <?php if ($rental['return_status'] == 1): ?>
                                    <span class="badge badge-success">Sudah Dikembalikan</span>
                                    <?php else: ?>
                                    <span class="badge badge-warning">Belum Dikembalikan</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $rental['item_count'] ?></td>
                                <td>Rp. <?= number_format($rental['total_price'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($rental['payment_status'] == 1): ?>
                                    <span class="badge badge-success">Lunas</span>
                                    <?php else: ?>
                                    <span class="badge badge-warning">Belum Lunas</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm">Detail</a>
                                    <a href="#" class="btn btn-primary btn-sm">Cetak</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
$(document).ready(function() {
    // Apply filter
    $('#filterBtn').on('click', function() {
        var bulan = $('#filterBulan').val();
        var tahun = $('#filterTahun').val();

        // You can implement the filtering logic here
        // For now, we'll just log the selected filters
        console.log('Bulan:', bulan, 'Tahun:', tahun);

        // After filtering, you can update the table data or make an Ajax call to fetch the filtered data
    });

    // Export PDF Button
    $('#exportPdfBtn').on('click', function() {
        // Logic to export table to PDF
        alert('Export to PDF');
    });

    // Export Excel Button
    $('#exportExcelBtn').on('click', function() {
        // Logic to export table to Excel
        alert('Export to Excel');
    });
});
</script>

<style>
/* Custom background color for the card header */
.custom-header-bg {
    background-color: #4caf50;
    /* Ganti warna sesuai keinginan */
    color: white;
    /* Mengubah teks menjadi putih agar kontras */
}

.ml-auto {
    margin-left: auto;
}

.text-right {
    text-align: right;
}
</style>
<?= $this->endSection() ?>