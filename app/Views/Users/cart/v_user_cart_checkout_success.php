<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Success Header with Animation -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="success-animation mb-4">
                        <div class="checkmark-container">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="m14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                    </div>
                    <h1 class="display-4 text-success font-weight-bold mb-3">
                        <i class="fas fa-check-circle"></i> Transaksi Berhasil!
                    </h1>
                    <p class="lead text-muted mb-4">
                        Terima kasih! Transaksi Anda telah berhasil dibuat dan sedang menunggu konfirmasi pembayaran.
                    </p>
                    <div class="alert alert-info d-inline-block">
                        <i class="fas fa-info-circle"></i>
                        <strong>Langkah Selanjutnya:</strong> Silakan upload bukti pembayaran untuk menyelesaikan transaksi
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- Progress Steps -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="step-item completed">
                                        <div class="step-icon bg-success">
                                            <i class="fas fa-shopping-cart text-white"></i>
                                        </div>
                                        <h6 class="mt-2">Pilih Items</h6>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="step-item completed">
                                        <div class="step-icon bg-success">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <h6 class="mt-2">Data Customer</h6>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="step-item completed">
                                        <div class="step-icon bg-success">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                        <h6 class="mt-2">Transaksi Dibuat</h6>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="step-item active">
                                        <div class="step-icon bg-warning">
                                            <i class="fas fa-credit-card text-white"></i>
                                        </div>
                                        <h6 class="mt-2">Konfirmasi Pembayaran</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Detail Transaksi -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-gradient-success text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-receipt mr-2"></i>
                                        Detail Transaksi
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="transaction-details">
                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-hashtag text-primary"></i>
                                                <strong>Kode Transaksi</strong>
                                            </div>
                                            <div class="detail-value">
                                                <span class="badge badge-primary badge-lg">
                                                    <?= esc($transaction['transaction_code']) ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-user text-info"></i>
                                                <strong>Nama Penyewa</strong>
                                            </div>
                                            <div class="detail-value">
                                                <?= esc($transaction['customer_name']) ?>
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-map-marker-alt text-danger"></i>
                                                <strong>Alamat Penyewa</strong>
                                            </div>
                                            <div class="detail-value">
                                                <?= esc($transaction['address']) ?>
                                            </div>
                                        </div>

                                        <div class="detail-item total-price">
                                            <div class="detail-label">
                                                <i class="fas fa-money-bill-wave text-success"></i>
                                                <strong>Total Harga</strong>
                                            </div>
                                            <div class="detail-value">
                                                <span class="h4 text-success font-weight-bold">
                                                    Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-credit-card text-warning"></i>
                                                <strong>Metode Pembayaran</strong>
                                            </div>
                                            <div class="detail-value">
                                                <?php if ($transaction['payment_type'] == 2): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-university"></i> Transfer Bank
                                                    </span>
                                                <?php elseif ($transaction['payment_type'] == 1): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-money-bill"></i> Cash/Tunai
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-warning">
                                                        <i class="fas fa-exclamation-triangle"></i> Error
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="mt-4 text-center">
                                        <button class="btn btn-outline-primary btn-sm" onclick="window.print()">
                                            <i class="fas fa-print"></i> Cetak Detail
                                        </button>
                                        <a href="<?= base_url('user/transactions') ?>" class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-history"></i> Riwayat Transaksi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Konfirmasi Pembayaran -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-gradient-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i>
                                        Konfirmasi Pembayaran
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <!-- Informasi Pembayaran -->
                                    <div class="payment-info mb-4">
                                        <div class="alert alert-warning">
                                            <h6 class="alert-heading">
                                                <i class="fas fa-info-circle"></i> Informasi Pembayaran
                                            </h6>
                                            <p class="mb-1">Silakan transfer ke rekening berikut:</p>
                                            <hr>
                                            <div class="bank-info">
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>Bank</strong></div>
                                                    <div class="col-sm-8">: BCA</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>No. Rekening</strong></div>
                                                    <div class="col-sm-8">: 1234567890</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>Atas Nama</strong></div>
                                                    <div class="col-sm-8">: Ngesti Gongso Kemojing</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="<?= base_url('user/payment/confirm') ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field() ?>

                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-hashtag"></i> Kode Transaksi
                                            </label>
                                            <input type="text" name="transaction_code" class="form-control form-control-lg" 
                                                   value="<?= esc($transaction['transaction_code']) ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-image"></i> Upload Bukti Pembayaran <span class="text-danger">*</span>
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" name="proof_of_payment" class="custom-file-input" 
                                                       id="proof_of_payment" required accept="image/*">
                                                <label class="custom-file-label" for="proof_of_payment">
                                                    Pilih file bukti pembayaran...
                                                </label>
                                            </div>
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info"></i>
                                                Format: JPG, JPEG, PNG | Maksimal: 2MB
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <div class="upload-preview" id="uploadPreview" style="display: none;">
                                                <label class="form-label">Preview:</label>
                                                <div class="preview-container">
                                                    <img id="imagePreview" class="img-fluid rounded border" style="max-height: 200px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                                <i class="fas fa-paper-plane mr-2"></i>
                                                Kirim Konfirmasi Pembayaran
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">
                                        <i class="fas fa-lightbulb text-warning"></i>
                                        Tips & Informasi Penting
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-item">
                                                <i class="fas fa-clock text-primary"></i>
                                                <h6>Waktu Konfirmasi</h6>
                                                <p class="text-muted small">Konfirmasi pembayaran akan diproses dalam 1x24 jam setelah upload bukti.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item">
                                                <i class="fas fa-phone text-success"></i>
                                                <h6>Butuh Bantuan?</h6>
                                                <p class="text-muted small">Hubungi customer service di <strong>+62 812-3456-7890</strong> untuk bantuan.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item">
                                                <i class="fas fa-shield-alt text-info"></i>
                                                <h6>Keamanan Data</h6>
                                                <p class="text-muted small">Data transaksi Anda aman dan terlindungi dengan enkripsi SSL.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Success Animation */
.success-animation {
    animation: slideInDown 0.8s ease-out;
}

.checkmark-container {
    width: 80px;
    height: 80px;
    margin: 0 auto;
}

.checkmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #28a745;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #28a745;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke-miterlimit: 10;
    stroke: #28a745;
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }
    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #28a745;
    }
}

@keyframes slideInDown {
    from {
        transform: translate3d(0, -100%, 0);
        visibility: visible;
    }
    to {
        transform: translate3d(0, 0, 0);
    }
}

/* Step Progress */
.step-item {
    position: relative;
    margin-bottom: 20px;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 18px;
    transition: all 0.3s ease;
}

.step-item.completed .step-icon {
    animation: pulse 1s ease-in-out;
}

.step-item.active .step-icon {
    animation: bounce 1s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

/* Detail Items */
.transaction-details {
    space-y: 15px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item.total-price {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    margin: 15px -15px;
    padding: 20px 15px;
    border-radius: 8px;
    border: none;
}

.detail-label {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #495057;
}

.detail-value {
    font-weight: 500;
    color: #212529;
}

/* Info Items */
.info-item {
    text-align: center;
    padding: 20px 10px;
}

.info-item i {
    font-size: 2rem;
    margin-bottom: 10px;
    display: block;
}

.info-item h6 {
    margin-bottom: 10px;
    font-weight: 600;
}

/* Card Enhancements */
.card {
    border: none;
    border-radius: 12px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
}

/* Badge Enhancements */
.badge-lg {
    font-size: 1rem;
    padding: 8px 16px;
}

/* Form Enhancements */
.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
}

.custom-file-label::after {
    background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
    color: white;
}

/* Bank Info */
.bank-info .row {
    margin-bottom: 5px;
}

/* Responsive */
@media (max-width: 768px) {
    .display-4 {
        font-size: 2rem;
    }
    
    .step-item {
        margin-bottom: 15px;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .detail-item.total-price {
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Custom file input
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
        
        // Show preview
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#uploadPreview').show();
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Print functionality
    window.print = function() {
        var printContents = document.querySelector('.transaction-details').outerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = `
            <div style="padding: 20px; font-family: Arial, sans-serif;">
                <h2>Detail Transaksi</h2>
                ${printContents}
            </div>
        `;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    };
});
</script>

<?= $this->endSection() ?>