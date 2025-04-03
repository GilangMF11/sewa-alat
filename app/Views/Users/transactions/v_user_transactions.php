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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Nama Penyewa</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rentals as $rental): ?>
                    <tr>
                        <td><?= esc($rental['transaction_code']) ?></td>
                        <td><?= esc($rental['customer_name']) ?></td>
                        <td><?= date('d-m-Y', strtotime($rental['created_at'])) ?></td>
                        <td>
                            <?= ($rental['return_status'] == 'returned')
                                ? '<span class="badge badge-success">Dikembalikan</span>'
                                : '<span class="badge badge-warning">Belum</span>' ?>
                        </td>
                        <td>Rp <?= number_format($rental['total_price'], 0, ',', '.') ?></td>
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
