<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Admin</h1>
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

            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $items; ?></h3>
                            <p>Total Produk</p>
                        </div>
                        <div class="icon"><i class="fas fa-box"></i></div>
                        <a href="<?= base_url('admin/items') ?>" class="small-box-footer">Kelola Items <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $transactions; ?></h3>
                            <p>Transaksi Hari Ini</p>
                        </div>
                        <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                        <a href="<?= base_url('admin/transactions') ?>" class="small-box-footer">Lihat Transaksi <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Rp <?= number_format($today_revenue, 0, ',', '.'); ?></h3>
                            <p>Pendapatan Hari Ini</p>
                        </div>
                        <div class="icon"><i class="fas fa-wallet"></i></div>
                        <a href="<?= base_url('admin/reports') ?>" class="small-box-footer">Lihat Laporan <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $users; ?></h3>
                            <p>Total Pengguna</p>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <a href="<?= base_url('admin/users') ?>" class="small-box-footer">Kelola User <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Alert Cards untuk Admin -->
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-exclamation-triangle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Stok Rendah</span>
                            <span class="info-box-number"><?= $low_stock_items; ?></span>
                            <small>Items dengan stok < 5</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-credit-card"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pembayaran Pending</span>
                            <span class="info-box-number"><?= $pending_payments; ?></span>
                            <small>Transaksi belum dibayar</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-undo"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Belum Dikembalikan</span>
                            <span class="info-box-number"><?= $pending_returns; ?></span>
                            <small>Items belum kembali</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-layer-group"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kategori</span>
                            <span class="info-box-number"><?= $categories; ?></span>
                            <small>Total kategori produk</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Grafik Pendapatan Bulanan -->
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Pendapatan Bulanan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Items yang Paling Sering Disewa -->
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Items Terpopuler</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <?php if (!empty($top_rented_items)): ?>
                                    <?php foreach ($top_rented_items as $index => $item): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge badge-primary badge-pill"><?= $index + 1 ?></span>
                                                <strong><?= esc($item['name']) ?></strong>
                                                <br>
                                                <small class="text-muted"><?= $item['rental_count'] ?>x disewa</small>
                                            </div>
                                            <span class="badge badge-success badge-pill"><?= $item['rental_count'] ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="list-group-item text-center text-muted">
                                        <i class="fas fa-info-circle"></i> Belum ada data
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Terbaru</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Return</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recent_transactions)): ?>
                                        <?php foreach ($recent_transactions as $transaction): ?>
                                            <tr>
                                                <td><?= esc($transaction['transaction_code']) ?></td>
                                                <td><?= esc($transaction['customer_name']) ?></td>
                                                <td>Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($transaction['created_at'])) ?></td>
                                                <td>
                                                    <?php if ($transaction['payment_status'] == 0): ?>
                                                        <span class="badge badge-danger">Belum Bayar</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-success">Lunas</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($transaction['return_status'] == 0): ?>
                                                        <span class="badge badge-warning">Belum Kembali</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-info">Sudah Kembali</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                <i class="fas fa-info-circle"></i> Belum ada transaksi
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?= base_url('rental-status') ?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Lihat Semua Transaksi
                            </a>
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

    const ctx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Pendapatan Bulanan (Rp)',
                data: chartData.data.map(val => parseFloat(val)),
                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
});
</script>
<?= $this->endSection() ?>