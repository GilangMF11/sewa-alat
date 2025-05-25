<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                    <p class="text-muted">Selamat datang, <?= session()->get('name') ?>!</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Info boxes untuk User -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $user_rentals; ?></h3>
                            <p>Total Rental Saya</p>
                        </div>
                        <div class="icon"><i class="fas fa-history"></i></div>
                        <a href="<?= base_url('user/rental-history') ?>" class="small-box-footer">
                            Lihat Riwayat <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $active_rentals; ?></h3>
                            <p>Rental Aktif</p>
                        </div>
                        <div class="icon"><i class="fas fa-clock"></i></div>
                        <a href="<?= base_url('user/active-rentals') ?>" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Rp <?= number_format($total_spent, 0, ',', '.'); ?></h3>
                            <p>Total yang Dihabiskan</p>
                        </div>
                        <div class="icon"><i class="fas fa-wallet"></i></div>
                        <a href="<?= base_url('user/payment-history') ?>" class="small-box-footer">
                            Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $pending_payments; ?></h3>
                            <p>Menunggu Pembayaran</p>
                        </div>
                        <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
                        <a href="<?= base_url('user/pending-payments') ?>" class="small-box-footer">
                            Bayar Sekarang <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Grafik Rental Bulanan -->
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Aktivitas Rental Saya</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="userRentalChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items Favorit -->
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Items Favorit Saya</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <?php if (!empty($favorite_items)): ?>
                                    <?php foreach ($favorite_items as $item): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong><?= esc($item['name']) ?></strong>
                                                <br>
                                                <small class="text-muted"><?= $item['rental_count'] ?>x disewa</small>
                                            </div>
                                            <span class="badge badge-primary badge-pill"><?= $item['rental_count'] ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="list-group-item text-center text-muted">
                                        <i class="fas fa-info-circle"></i> Belum ada item favorit
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Riwayat Rental Terbaru -->
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Rental Terbaru</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Items</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($rental_history)): ?>
                                            <?php foreach ($rental_history as $rental): ?>
                                                <tr>
                                                    <td>
                                                        <small><?= esc($rental['transaction_code']) ?></small>
                                                        <br>
                                                        <small class="text-muted"><?= date('d/m/Y', strtotime($rental['created_at'])) ?></small>
                                                    </td>
                                                    <td>
                                                        <small><?= esc(substr($rental['item_names'], 0, 30)) ?><?= strlen($rental['item_names']) > 30 ? '...' : '' ?></small>
                                                    </td>
                                                    <td>
                                                        <small>Rp <?= number_format($rental['total_price'], 0, ',', '.') ?></small>
                                                    </td>
                                                    <td>
                                                        <?php if ($rental['payment_status'] == 0): ?>
                                                            <span class="badge badge-warning">Belum Bayar</span>
                                                        <?php elseif ($rental['return_status'] == 0): ?>
                                                            <span class="badge badge-info">Belum Kembali</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-success">Selesai</span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">
                                                    <i class="fas fa-info-circle"></i> Belum ada riwayat rental
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?= base_url('user/rental-history') ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Items Tersedia -->
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Items Tersedia untuk Disewa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if (!empty($available_items)): ?>
                                    <?php foreach (array_slice($available_items, 0, 6) as $item): ?>
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <div class="card card-outline card-primary" style="height: 200px;">
                                                <div class="card-body p-2 text-center">
                                                    <?php if ($item['image']): ?>
                                                        <img src="<?= base_url('uploads/items/' . $item['image']) ?>" 
                                                             alt="<?= esc($item['name']) ?>" 
                                                             class="img-fluid rounded mb-2" 
                                                             style="height: 60px; object-fit: cover;">
                                                    <?php else: ?>
                                                        <div class="bg-light rounded mb-2 d-flex align-items-center justify-content-center" style="height: 60px;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <h6 class="card-title mb-1" style="font-size: 12px;">
                                                        <?= esc(substr($item['name'], 0, 20)) ?><?= strlen($item['name']) > 20 ? '...' : '' ?>
                                                    </h6>
                                                    <p class="text-muted mb-1" style="font-size: 10px;">
                                                        <?= esc($item['category_name'] ?? 'Tanpa Kategori') ?>
                                                    </p>
                                                    <p class="text-success mb-1" style="font-size: 11px;">
                                                        <strong>Rp <?= number_format($item['price'], 0, ',', '.') ?></strong>
                                                    </p>
                                                    <small class="text-info">Stok: <?= $item['stock'] ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12 text-center text-muted">
                                        <i class="fas fa-info-circle"></i> Tidak ada item tersedia
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?= base_url('items') ?>" class="btn btn-sm btn-warning">
                                <i class="fas fa-shopping-cart"></i> Lihat Semua Items
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Aksi Cepat</h3>
                        </div>
                        <div class="card-body text-center">
                            <a href="<?= base_url('items') ?>" class="btn btn-primary mr-2">
                                <i class="fas fa-shopping-cart"></i> Sewa Items
                            </a>
                            <a href="<?= base_url('user/rental-history') ?>" class="btn btn-info mr-2">
                                <i class="fas fa-history"></i> Riwayat Rental
                            </a>
                            <a href="<?= base_url('user/profile') ?>" class="btn btn-success mr-2">
                                <i class="fas fa-user"></i> Edit Profile
                            </a>
                            <?php if ($pending_payments > 0): ?>
                                <a href="<?= base_url('user/pending-payments') ?>" class="btn btn-warning mr-2">
                                    <i class="fas fa-credit-card"></i> Bayar Sekarang (<?= $pending_payments ?>)
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const chartData = JSON.parse(`<?= esc($chartData, 'js') ?>`);

    const ctx = document.getElementById('userRentalChart').getContext('2d');
    const userRentalChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Jumlah Rental per Bulan',
                data: chartData.data,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' rental';
                        }
                    }
                }
            }
        }
    });
});
</script>

<?= $this->endSection() ?>