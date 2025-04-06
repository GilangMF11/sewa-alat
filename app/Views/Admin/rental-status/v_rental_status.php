<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Status Sewa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Status Sewa</li>
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
                    <h3 class="card-title font-weight-bold">Status Sewa Barang</h3>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <div class="row mb-3">
                        <form method="get" action="<?= base_url('rental-status') ?>" class="form-inline">
                            <select name="status" class="form-control">
                                <option value="">Status</option>
                                <option value="1" <?= ($_GET['status'] ?? '') == '1' ? 'selected' : '' ?>>Sudah
                                    Dikembalikan</option>
                                <option value="0" <?= ($_GET['status'] ?? '') == '0' ? 'selected' : '' ?>>Belum
                                    Dikembalikan</option>
                            </select>

                            <select name="bulan" class="form-control mx-2">
                                <option value="">Pilih Bulan</option>
                                <option value="01" <?= ($_GET['bulan'] ?? '') == '01' ? 'selected' : '' ?>>Januari
                                </option>
                                <option value="02" <?= ($_GET['bulan'] ?? '') == '02' ? 'selected' : '' ?>>Februari
                                </option>
                                <option value="03" <?= ($_GET['bulan'] ?? '') == '03' ? 'selected' : '' ?>>Maret
                                </option>
                                <option value="04" <?= ($_GET['bulan'] ?? '') == '04' ? 'selected' : '' ?>>April
                                </option>
                                <option value="05" <?= ($_GET['bulan'] ?? '') == '05' ? 'selected' : '' ?>>Mei</option>
                                <option value="06" <?= ($_GET['bulan'] ?? '') == '06' ? 'selected' : '' ?>>Juni</option>
                                <option value="07" <?= ($_GET['bulan'] ?? '') == '07' ? 'selected' : '' ?>>Juli</option>
                                <option value="08" <?= ($_GET['bulan'] ?? '') == '08' ? 'selected' : '' ?>>Agustus
                                </option>
                                <option value="09" <?= ($_GET['bulan'] ?? '') == '09' ? 'selected' : '' ?>>September
                                </option>
                                <option value="10" <?= ($_GET['bulan'] ?? '') == '10' ? 'selected' : '' ?>>Oktober
                                </option>
                                <option value="11" <?= ($_GET['bulan'] ?? '') == '11' ? 'selected' : '' ?>>November
                                </option>
                                <option value="12" <?= ($_GET['bulan'] ?? '') == '12' ? 'selected' : '' ?>>Desember
                                </option>
                            </select>

                            <select name="tahun" class="form-control mx-2">
                                <option value="">Pilih Tahun</option>
                                <option value="2025" <?= ($_GET['tahun'] ?? '') == '2025' ? 'selected' : '' ?>>2025
                                </option>
                                <option value="2024" <?= ($_GET['tahun'] ?? '') == '2024' ? 'selected' : '' ?>>2024
                                </option>
                                <option value="2023" <?= ($_GET['tahun'] ?? '') == '2023' ? 'selected' : '' ?>>2023
                                </option>
                                <option value="2022" <?= ($_GET['tahun'] ?? '') == '2022' ? 'selected' : '' ?>>2022
                                </option>
                            </select>

                            <button class="btn btn-primary ml-2">Cari</button>
                        </form>

                        
                    </div>
                    <!-- Filter Form End -->

                    <!-- Tabel -->
                    <table class="table table-bordered table-striped table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Penyewa</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status Sewa</th>
                                <th>Jumlah</th>
                                <th>Ongkir</th>
                                <th>DP</th>
                                <th>Total</th>
                                <th>Status</th>
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
                                <td>Rp. <?= number_format($rental['down_payment'], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($rental['shipping_cost'], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($rental['total_price'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($rental['payment_status'] == 1): ?>
                                    <span class="badge badge-success">Lunas</span>
                                    <?php else: ?>
                                    <span class="badge badge-warning">Belum Lunas</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm btn-detail" data-toggle="modal"
                                        data-target="#modalUpdate" data-id="<?= $rental['id'] ?>">Detail</button>
                                        <a href="<?= base_url('rental-status/print/' . $rental['id']) ?>" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Modal Detail Transaksi -->
                    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="<?= base_url('rental-status/update') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Transaksi</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Tampilkan Data Transaksi -->
                                        <div class="form-group">
                                            <label for="transaction_code">ID Transaksi</label>
                                            <input type="text" class="form-control" id="transaction_code"
                                                value="<?= esc($rental['transaction_code']) ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer_name">Nama Penyewa</label>
                                            <input type="text" class="form-control" id="customer_name"
                                                value="<?= esc($rental['customer_name']) ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_price">Total Harga</label>
                                            <input type="text" class="form-control" id="total_price"
                                                value="Rp. <?= number_format($rental['total_price'], 0, ',', '.') ?>"
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control" id="address"
                                                value="<?= esc($rental['address']) ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="shipping_cost">Biaya Pengiriman</label>
                                            <input type="text" class="form-control" id="shipping_cost"
                                                value="Rp. <?= number_format($rental['shipping_cost'], 0, ',', '.') ?>"
                                                disabled>
                                        </div>

                                        <!-- Dropdown untuk Status Pembayaran dan Sewa -->
                                        <div class="form-group">
                                            <label for="payment_status">Status Pembayaran</label>
                                            <select name="payment_status" class="form-control" id="payment_status">
                                                <option value="1"
                                                    <?= $rental['payment_status'] == 1 ? 'selected' : '' ?>>Lunas
                                                </option>
                                                <option value="0"
                                                    <?= $rental['payment_status'] == 0 ? 'selected' : '' ?>>Belum Lunas
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="return_status">Status Sewa</label>
                                            <select name="return_status" class="form-control" id="return_status">
                                                <option value="1"
                                                    <?= $rental['return_status'] == 1 ? 'selected' : '' ?>>Sudah
                                                    Dikembalikan</option>
                                                <option value="0"
                                                    <?= $rental['return_status'] == 0 ? 'selected' : '' ?>>Belum
                                                    Dikembalikan</option>
                                            </select>
                                        </div>

                                        <!-- Tampilkan Barang yang Disewa -->
                                        <h5>Barang yang Disewa</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Tanggal Pinjam</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rental['items'] as $item): ?>
                                                <tr>
                                                    <td><?= esc($item['item_name']) ?></td>
                                                    <td><?= esc($item['quantity']) ?></td>
                                                    <td><?= esc(date('Y-m-d', strtotime($item['borrow_date']))) ?></td>
                                                    <td><?= esc(date('Y-m-d', strtotime($item['return_date']))) ?></td>
                                                    <td>Rp. <?= number_format($item['price'], 0, ',', '.') ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success">Simpan Perubahan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal Update
    $('#modalUpdate').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var payment_status = button.data('payment_status');
        var return_status = button.data('return_status');
        var customer_name = button.data('customer_name');
        var total_price = button.data('total_price');

        var modal = $(this);
        modal.find('.modal-body #modal-id').val(id);
        modal.find('.modal-body #modal-status_sewa').val(return_status);
        modal.find('.modal-body #modal-status_pembayaran').val(payment_status);
        modal.find('.modal-body #modal-total_price').val(total_price);
    });
});
$(document).ready(function() {
    // Filter button action
    $('#filterBtn').on('click', function() {
        var bulan = $('#filterBulan').val();
        var tahun = $('#filterTahun').val();
        console.log('Bulan:', bulan, 'Tahun:', tahun);
    });

    // Export PDF button
    $('#exportPdfBtn').on('click', function() {
        alert('Export to PDF');
    });

    // Export Excel button
    $('#exportExcelBtn').on('click', function() {
        alert('Export to Excel');
    });
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