<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Transaksi Saya</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (empty($rentals)) : ?>
                <div class="alert alert-info">Belum ada transaksi.</div>
            <?php else: ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rentals as $rental): ?>
                    <tr>
                        <td><?= esc($rental['transaction_code']) ?></td>
                        <td><?= date('d-m-Y', strtotime($rental['created_at'])) ?></td>

                        <td>Rp <?= number_format($rental['total_price'], 0, ',', '.') ?></td>
                        <?php if ($rental['payment_status'] == 2): ?>
                            <td><span class="badge badge-warning">Pending</span></td>
                        <?php elseif ($rental['payment_status'] == 1): ?>
                            <td><span class="badge badge-success">Lunas</span></td>
                        <?php else: ?>
                            <td><span class="badge badge-danger">Belum Lunas</span></td>
                        <?php endif; ?>
                        <td>
                            <a href="<?= base_url('user/transactions/detail/' . $rental['id']) ?>" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php endif ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
