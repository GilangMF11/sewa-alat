<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<style>
    .blink-red {
        color: red;
        animation: blink-animation 1s steps(2, start) infinite;
        font-weight: bold;
    }

    @keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Detail Transaksi</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (empty($rental)): ?>
                <div class="alert alert-info">Transaksi tidak ditemukan.</div>
            <?php else: ?>
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Informasi Transaksi</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>Kode Transaksi</strong></td>
                                    <td><?= esc($rental['transaction_code']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Penyewa</strong></td>
                                    <td><?= esc($rental['customer_name']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat Penyewa</strong></td>
                                    <td><?= esc($rental['address']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Ongkos Kirim</strong><span class="blink-red pl-2"><a href="https://wa.me/6282188865677?text=Halo,%20saya%20telah%20melakukan%20transfer%20untuk%20kode%20transaksi%20<?= urlencode($rental['transaction_code']) ?> dan berapa ongkirnya? ">Klik Tanya Admin</a></span></td>
                                    <td>Rp <?= number_format($rental['shipping_cost'], 0, ',', '.') ?> </td>
                                </tr>
                                <tr>
                                    <td><strong>Status Pembayaran</strong></td>
                                    <td>
                                        <?php if ($rental['payment_status'] == 2): ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php elseif ($rental['payment_status'] == 1): ?>
                                            <span class="badge badge-success">Lunas</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Belum Lunas</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Transaksi</strong></td>
                                    <td><?= date('d-m-Y', strtotime($rental['created_at'])) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Detail Barang yang Disewa</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rentalItems as $item): ?>
                                    <tr>
                                        <td><?= esc($item['item_name']) ?></td>
                                        <td><?= esc($item['quantity']) ?></td>
                                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Total</th>
                                    <th>Rp <?= number_format($rental['total_price'], 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <?php if ($rental['payment_status'] == 1 || $rental['payment_status'] == 2 || $rental['proof_of_payment'] == null): ?>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Konfirmasi Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('user/payment/confirm') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label>Kode Transaksi</label>
                                    <input type="text" name="transaction_code" class="form-control" value="<?= esc($rental['transaction_code']) ?>" readonly>
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

                    <!-- Card Tata Cara Pembayaran Transfer -->
                <div class="card mt-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Tata Cara Pembayaran Transfer</h5>
                    </div>
                    <div class="card-body">
                        <h6><strong>1. Transfer ke rekening berikut:</strong></h6>
                        <ul>
                            <li><strong>Bank ABC</strong> - 123-456-7890 (A/N Toko Sewa Alat)</li>
                            <li><strong>Bank XYZ</strong> - 987-654-3210 (A/N Toko Sewa Alat)</li>
                        </ul>

                        <h6><strong>2. Pastikan jumlah yang dibayar sesuai:</strong></h6>
                        <p>Harap transfer sesuai dengan total yang tertera di halaman transaksi. Jika terdapat biaya pengiriman, harap bayar sesuai dengan jumlah yang tertera di total harga.</p>

                        <h6><strong>3. Kirim bukti pembayaran:</strong></h6>
                        <p>Setelah transfer, kirimkan bukti pembayaran ke nomor WhatsApp kami melalui tombol <strong>Sewa Sekarang</strong> pada halaman ini, atau gunakan tombol di bawah.</p>

                        <div class="text-center">
                            <a href="https://wa.me/6282188865677?text=Halo,%20saya%20telah%20melakukan%20transfer%20untuk%20kode%20transaksi%20<?= urlencode($rental['transaction_code']) ?>"
                               target="_blank" class="btn btn-success">
                               <i class="fab fa-whatsapp"></i> Kirim Bukti Pembayaran via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
