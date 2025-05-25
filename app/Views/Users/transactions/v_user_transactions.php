<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Enhanced Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 display-4 font-weight-bold text-primary">
                        <i class="fas fa-history mr-3"></i>Transaksi Saya
                    </h1>
                    <p class="text-muted">Riwayat semua transaksi penyewaan Anda</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= count($rentals) ?></h3>
                            <p>Total Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= count(array_filter($rentals, fn($r) => $r['payment_status'] == 1)) ?></h3>
                            <p>Transaksi Lunas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= count(array_filter($rentals, fn($r) => $r['payment_status'] == 0)) ?></h3>
                            <p>Belum Lunas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Rp <?= number_format(array_sum(array_column(array_filter($rentals, fn($r) => $r['payment_status'] == 1), 'total_price')), 0, ',', '.') ?></h3>
                            <p>Total Pembayaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-filter mr-2"></i>Filter Transaksi
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status Pembayaran</label>
                                        <select class="form-control" id="filterPayment">
                                            <option value="">Semua Status</option>
                                            <option value="1">Lunas</option>
                                            <option value="0">Belum Lunas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status Pengembalian</label>
                                        <select class="form-control" id="filterReturn">
                                            <option value="">Semua Status</option>
                                            <option value="1">Sudah Dikembalikan</option>
                                            <option value="0">Belum Dikembalikan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <select class="form-control" id="filterMonth">
                                            <option value="">Semua Bulan</option>
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?= $i ?>"><?= date('F', mktime(0, 0, 0, $i, 1)) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select class="form-control" id="filterYear">
                                            <option value="">Semua Tahun</option>
                                            <?php for ($year = date('Y'); $year >= date('Y') - 3; $year--): ?>
                                                <option value="<?= $year ?>"><?= $year ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-secondary" id="resetFilter">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button class="btn btn-primary" id="applyFilter">
                                    <i class="fas fa-search"></i> Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <?php if (empty($rentals)) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-file-invoice fa-5x text-muted mb-4"></i>
                                    <h4 class="text-muted">Belum Ada Transaksi</h4>
                                    <p class="text-muted mb-4">Anda belum memiliki riwayat transaksi penyewaan.</p>
                                    <a href="<?= base_url('items') ?>" class="btn btn-primary btn-lg">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Mulai Sewa Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-gradient-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-list mr-2"></i>
                                    Daftar Transaksi
                                </h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table id="transactionsTable" class="table table-hover mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th><i class="fas fa-hashtag"></i> Kode Transaksi</th>
                                                <th><i class="fas fa-calendar"></i> Tanggal</th>
                                                <th><i class="fas fa-money-bill"></i> Total Harga</th>
                                                <th><i class="fas fa-credit-card"></i> Status Pembayaran</th>
                                                <th><i class="fas fa-undo"></i> Status Pengembalian</th>
                                                <th><i class="fas fa-cogs"></i> Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rentals as $rental): ?>
                                            <tr class="transaction-row" 
                                                data-payment="<?= $rental['payment_status'] ?>"
                                                data-return="<?= $rental['return_status'] ?>"
                                                data-month="<?= date('n', strtotime($rental['created_at'])) ?>"
                                                data-year="<?= date('Y', strtotime($rental['created_at'])) ?>">
                                                <td>
                                                    <span class="font-weight-bold text-primary">
                                                        <?= esc($rental['transaction_code']) ?>
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?= date('H:i', strtotime($rental['created_at'])) ?> WIB
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold">
                                                        <?= date('d M Y', strtotime($rental['created_at'])) ?>
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?= date('d M Y', strtotime($rental['created_at']))  ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold text-success h6">
                                                        Rp <?= number_format($rental['total_price'], 0, ',', '.') ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($rental['payment_status'] == 1): ?>
                                                        <span class="badge badge-success badge-lg">
                                                            <i class="fas fa-check-circle"></i> Lunas
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger badge-lg">
                                                            <i class="fas fa-times-circle"></i> Belum Lunas
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($rental['return_status'] == 1): ?>
                                                        <span class="badge badge-info badge-lg">
                                                            <i class="fas fa-check"></i> Sudah Dikembalikan
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-warning badge-lg">
                                                            <i class="fas fa-clock"></i> Belum Dikembalikan
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="<?= base_url('user/transactions/detail/' . $rental['id']) ?>" 
                                                           class="btn btn-info btn-sm" data-toggle="tooltip" title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="<?= base_url('user/transactions/print/' . $rental['id']) ?>" 
                                                           class="btn btn-success btn-sm" target="_blank" data-toggle="tooltip" title="Cetak Struk">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                        <?php if ($rental['payment_status'] == 0): ?>
                                                            <a href="<?= base_url('user/payment/confirm/' . $rental['transaction_code']) ?>" 
                                                               class="btn btn-warning btn-sm" data-toggle="tooltip" title="Upload Bukti Pembayaran">
                                                                <i class="fas fa-upload"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <small class="text-muted">
                                            Menampilkan <?= count($rentals) ?> transaksi
                                        </small>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="<?= base_url('items') ?>" class="btn btn-primary">
                                            <i class="fas fa-plus mr-2"></i>Sewa Lagi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-bolt mr-2"></i>Aksi Cepat
                            </h6>
                        </div>
                        <div class="card-body text-center">
                            <a href="<?= base_url('items') ?>" class="btn btn-primary mr-2">
                                <i class="fas fa-shopping-cart"></i> Sewa Items Baru
                            </a>
                            <a href="<?= base_url('user/profile') ?>" class="btn btn-info mr-2">
                                <i class="fas fa-user"></i> Edit Profile
                            </a>
                            <a href="<?= base_url('user/help') ?>" class="btn btn-warning mr-2">
                                <i class="fas fa-question-circle"></i> Bantuan
                            </a>
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                                <i class="fas fa-home"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Enhanced Header */
.display-4 {
    font-size: 2.5rem;
}

/* Statistics Cards */
.small-box {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.small-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Table Enhancements */
.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
}

.table-hover tbody tr:hover {
    background-color: #f8f9ff;
}

/* Badge Enhancements */
.badge-lg {
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
}

/* Card Enhancements */
.card {
    border: none;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

/* Empty State */
.empty-state {
    padding: 3rem 2rem;
}

.empty-state i {
    opacity: 0.5;
}

/* Button Groups */
.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

/* Responsive Enhancements */
@media (max-width: 768px) {
    .display-4 {
        font-size: 1.8rem;
    }
    
    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    
    .btn-group .btn {
        margin-right: 0;
        border-radius: 4px !important;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
}

/* Loading Animation */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Filter Section */
.card-header.bg-light {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}

/* Transaction Row Highlighting */
.transaction-row.highlight {
    background-color: #fff3cd !important;
    animation: highlight 1s ease-in-out;
}

@keyframes highlight {
    0% { background-color: #fff3cd; }
    50% { background-color: #ffeaa7; }
    100% { background-color: #fff3cd; }
}

/* Status Icons */
.badge i {
    margin-right: 4px;
}

/* Action Buttons */
.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

/* Tooltip Styling */
.tooltip {
    font-size: 0.875rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Initialize DataTable if available
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#transactionsTable').DataTable({
            "responsive": true,
            "pageLength": 10,
            "order": [[1, "desc"]],
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    }
    
    // Filter functionality
    function applyFilters() {
        const paymentFilter = document.getElementById('filterPayment').value;
        const returnFilter = document.getElementById('filterReturn').value;
        const monthFilter = document.getElementById('filterMonth').value;
        const yearFilter = document.getElementById('filterYear').value;
        
        const rows = document.querySelectorAll('.transaction-row');
        
        rows.forEach(row => {
            let show = true;
            
            if (paymentFilter && row.dataset.payment !== paymentFilter) {
                show = false;
            }
            
            if (returnFilter && row.dataset.return !== returnFilter) {
                show = false;
            }
            
            if (monthFilter && row.dataset.month !== monthFilter) {
                show = false;
            }
            
            if (yearFilter && row.dataset.year !== yearFilter) {
                show = false;
            }
            
            row.style.display = show ? '' : 'none';
        });
        
        // Update count
        const visibleRows = document.querySelectorAll('.transaction-row[style=""], .transaction-row:not([style])');
        const countElement = document.querySelector('.card-footer small');
        if (countElement) {
            countElement.textContent = `Menampilkan ${visibleRows.length} transaksi`;
        }
    }
    
    // Apply filter button
    document.getElementById('applyFilter').addEventListener('click', applyFilters);
    
    // Reset filter button
    document.getElementById('resetFilter').addEventListener('click', function() {
        document.getElementById('filterPayment').value = '';
        document.getElementById('filterReturn').value = '';
        document.getElementById('filterMonth').value = '';
        document.getElementById('filterYear').value = '';
        applyFilters();
    });
    
    // Real-time filtering
    ['filterPayment', 'filterReturn', 'filterMonth', 'filterYear'].forEach(id => {
        document.getElementById(id).addEventListener('change', applyFilters);
    });
    
    // Highlight new transactions (if URL has highlight parameter)
    const urlParams = new URLSearchParams(window.location.search);
    const highlightId = urlParams.get('highlight');
    if (highlightId) {
        const row = document.querySelector(`[data-id="${highlightId}"]`);
        if (row) {
            row.classList.add('highlight');
            row.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
    
    // Confirm payment upload
    document.querySelectorAll('a[href*="payment/confirm"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const confirmed = confirm('Apakah Anda ingin mengupload bukti pembayaran untuk transaksi ini?');
            if (!confirmed) {
                e.preventDefault();
            }
        });
    });
    
    // Print confirmation
    document.querySelectorAll('a[href*="print"]').forEach(link => {
        link.addEventListener('click', function() {
            // Add loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.classList.add('disabled');
            
            // Reset after 3 seconds
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-print"></i>';
                this.classList.remove('disabled');
            }, 3000);
        });
    });
});
</script>

<?= $this->endSection() ?>