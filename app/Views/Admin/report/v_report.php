<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header -->
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

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card border-primary">
                <div class="card-header custom-header-bg">
                    <h3 class="card-title font-weight-bold">Laporan Transaksi Sewa Barang</h3>
                </div>
                <div class="card-body">
                    
                    <!-- Filter Form -->
                    <form method="get" action="<?= base_url('report') ?>" class="form-inline mb-3">
                        <select class="form-control mr-2" name="status">
                            <option value="">Pilih Status</option>
                            <option value="1" <?= ($_GET['status'] ?? '') == '1' ? 'selected' : '' ?>>Sudah Dikembalikan</option>
                            <option value="0" <?= ($_GET['status'] ?? '') == '0' ? 'selected' : '' ?>>Belum Dikembalikan</option>
                        </select>
                        <select class="form-control mr-2" name="bulan">
                            <option value="">Pilih Bulan</option>
                            <?php 
                            $bulan = [
                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                                '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                                '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                                '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                            ];
                            foreach ($bulan as $key => $value) {
                                $selected = ($_GET['bulan'] ?? '') == $key ? 'selected' : '';
                                echo "<option value=\"$key\" $selected>$value</option>";
                            }
                            ?>
                        </select>
                        <select class="form-control mr-2" name="tahun">
                            <option value="">Pilih Tahun</option>
                            <?php
                            $tahun = [2025, 2024, 2023, 2022];
                            foreach ($tahun as $thn) {
                                $selected = ($_GET['tahun'] ?? '') == $thn ? 'selected' : '';
                                echo "<option value=\"$thn\" $selected>$thn</option>";
                            }
                            ?>
                        </select>
                        <button class="btn btn-primary">Cari</button>
                    </form>

                    <!-- Export Buttons -->
                    <div class="text-right mb-3">
                        <a href="<?= base_url('report/export-pdf') ?>" class="btn btn-danger">Export PDF</a>
                        <a href="<?= base_url('report/export-excel') ?>" class="btn btn-success">Export Excel</a>
                    </div>

                    <!-- Table -->
                    <table class="table table-bordered table-striped table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Nama Penyewa</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status Sewa</th>
                                <th>Jumlah Item</th>
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
                                    <a href="<?= base_url('rental-status/print/' . $rental['id']) ?>" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Javascript -->
<script>
$(document).ready(function() {
    $('#example1').DataTable();
});
</script>

<style>
.custom-header-bg {
    background-color: #4caf50;
    color: white;
}
.ml-auto {
    margin-left: auto;
}
.text-right {
    text-align: right;
}
</style>

<?= $this->endSection() ?>
