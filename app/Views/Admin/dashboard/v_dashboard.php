<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
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
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- Total Produk -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $items; ?></h3> <!-- Contoh data statis -->
                                <p>Total Produk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <a href="<?= base_url('products') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Total Transaksi -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>200</h3> <!-- Contoh data statis -->
                                <p>Total Transaksi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="<?= base_url('transactions') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Total Pendapatan -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>Rp 100,000,000</h3> <!-- Contoh data statis -->
                                <p>Total Pendapatan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <a href="<?= base_url('reports') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Total Pengguna -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $users; ?></h3> <!-- Contoh data statis -->
                                <p>Total Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="<?= base_url('users') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Grafik Pendapatan Bulanan -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Grafik Pendapatan Bulanan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <canvas id="revenueChart" height="100"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Transaksi Terbaru -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Transaksi Terbaru</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Transaksi</th>
                                            <th>Nama Penyewa</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>John Doe</td>
                                            <td>Rp 500,000</td>
                                            <td>Confirmed</td>
                                            <td>2024-11-25</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jane Smith</td>
                                            <td>Rp 750,000</td>
                                            <td>Pending</td>
                                            <td>2024-11-24</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Michael Brown</td>
                                            <td>Rp 1,000,000</td>
                                            <td>Confirmed</td>
                                            <td>2024-11-23</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
<?= $this->endSection() ?>

<!-- Tambahkan Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Pendapatan Bulanan (Rp)',
                data: [1000000, 2000000, 1500000, 3000000, 4000000, 3500000, 4500000, 5000000, 6000000, 5500000, 7000000, 8000000],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
