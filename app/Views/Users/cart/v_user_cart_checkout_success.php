<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="mb-3">Checkout Berhasil</h1>
            <p class="lead">Terima kasih, transaksi Anda telah berhasil dibuat.</p>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- Ringkasan Transaksi dalam Tabel -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Detail Transaksi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Detail</th>
                                <th>Informasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Kode Transaksi</strong></td>
                                <td><?= esc($transaction['transaction_code']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nama Penyewa</strong></td>
                                <td><?= esc($transaction['customer_name']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Alamat Penyewa</strong></td>
                                <td><?= esc($transaction['address']) ?></td>
                            </tr>
                            <tr>
                                <td><strong>Total Harga</strong></td>
                                <td>Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td><strong>Metode Pembayaran</strong></td>
                                <?php if ($transaction['payment_type'] == 2): ?>
                            <td><span class="badge badge-success">Transfer</span></td>
                        <?php elseif ($transaction['payment_type'] == 1): ?>
                            <td><span class="badge badge-success">Cash</span></td>
                        <?php else: ?>
                            <td><span class="badge badge-warning">Error</span></td>
                        <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Konfirmasi Pembayaran -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Konfirmasi Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/payment/confirm') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label>Kode Transaksi</label>
                            <input type="text" name="transaction_code" class="form-control" value="<?= esc($transaction['transaction_code']) ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Upload Bukti Pembayaran</label>
                            <input type="file" name="proof_of_payment" class="form-control-file" required>
                            <small class="form-text text-muted">Format gambar (.jpg, .jpeg, .png), maksimal 2MB</small>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane"></i> Kirim Konfirmasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection() ?>
