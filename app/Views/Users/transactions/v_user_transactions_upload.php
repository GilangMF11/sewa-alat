<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Enhanced Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 display-4 font-weight-bold text-primary">
                        <i class="fas fa-upload mr-3"></i>Upload Bukti Pembayaran
                    </h1>
                    <p class="text-muted">Konfirmasi pembayaran untuk transaksi Anda</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('user/transactions') ?>">Transaksi</a></li>
                        <li class="breadcrumb-item active">Upload Bukti</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <!-- Progress Steps -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="checkout-progress">
                                <div class="progress-step completed">
                                    <div class="step-circle">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <span>Pilih Items</span>
                                </div>
                                <div class="progress-line completed"></div>
                                <div class="progress-step completed">
                                    <div class="step-circle">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>Checkout</span>
                                </div>
                                <div class="progress-line completed"></div>
                                <div class="progress-step completed">
                                    <div class="step-circle">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span>Transaksi Dibuat</span>
                                </div>
                                <div class="progress-line active"></div>
                                <div class="progress-step active">
                                    <div class="step-circle">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <span>Konfirmasi Pembayaran</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row">
                        <!-- Transaction Details -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-gradient-info text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-receipt mr-2"></i>
                                        Detail Transaksi
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($transaction)): ?>
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
                                                <i class="fas fa-calendar text-warning"></i>
                                                <strong>Tanggal Transaksi</strong>
                                            </div>
                                            <div class="detail-value">
                                                <?= date('d F Y, H:i', strtotime($transaction['created_at'])) ?> WIB
                                            </div>
                                        </div>

                                        <div class="detail-item total-price">
                                            <div class="detail-label">
                                                <i class="fas fa-money-bill-wave text-success"></i>
                                                <strong>Total Pembayaran</strong>
                                            </div>
                                            <div class="detail-value">
                                                <span class="h4 text-success font-weight-bold">
                                                    Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-info-circle text-danger"></i>
                                                <strong>Status</strong>
                                            </div>
                                            <div class="detail-value">
                                                <?php if ($transaction['payment_status'] == 1): ?>
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-check-circle"></i> Sudah Lunas
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-warning">
                                                        <i class="fas fa-clock"></i> Menunggu Pembayaran
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Data transaksi tidak ditemukan atau Anda tidak memiliki akses.
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information & Upload Form -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-gradient-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-university mr-2"></i>
                                        Informasi Pembayaran
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <!-- Bank Information -->
                                    <div class="payment-info mb-4">
                                        <div class="alert alert-info">
                                            <h6 class="alert-heading">
                                                <i class="fas fa-info-circle"></i> Rekening Tujuan Transfer
                                            </h6>
                                            <hr>
                                            <div class="bank-details">
                                                <div class="bank-item">
                                                    <div class="bank-logo">
                                                        <i class="fas fa-university text-primary"></i>
                                                    </div>
                                                    <div class="bank-info">
                                                        <strong>Bank BCA</strong><br>
                                                        <span class="account-number">1234567890</span><br>
                                                        <small>a.n. Ngesti Gongso Kemojing</small>
                                                    </div>
                                                    <div class="bank-action">
                                                        <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('1234567890')">
                                                            <i class="fas fa-copy"></i> Copy
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <div class="bank-item">
                                                    <div class="bank-logo">
                                                        <i class="fas fa-university text-warning"></i>
                                                    </div>
                                                    <div class="bank-info">
                                                        <strong>Bank Mandiri</strong><br>
                                                        <span class="account-number">0987654321</span><br>
                                                        <small>a.n. Ngesti Gongso Kemojing</small>
                                                    </div>
                                                    <div class="bank-action">
                                                        <button class="btn btn-sm btn-outline-warning" onclick="copyToClipboard('0987654321')">
                                                            <i class="fas fa-copy"></i> Copy
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Upload Form -->
                                    <?php if (isset($transaction) && $transaction['payment_status'] == 0): ?>
                                    <form action="<?= base_url('user/payment/confirm') ?>" method="post" enctype="multipart/form-data" id="uploadForm">
                                        <?= csrf_field() ?>
                                        
                                        <input type="hidden" name="transaction_code" value="<?= esc($transaction['transaction_code']) ?>">
                                        
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-image"></i> Upload Bukti Pembayaran <span class="text-danger">*</span>
                                            </label>
                                            <div class="upload-area" id="uploadArea">
                                                <div class="upload-content">
                                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                    <h5>Drag & Drop file di sini</h5>
                                                    <p class="text-muted">atau klik untuk memilih file</p>
                                                    <input type="file" name="proof_of_payment" id="proofFile" 
                                                           accept="image/*" required class="d-none">
                                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('proofFile').click()">
                                                        <i class="fas fa-folder-open"></i> Pilih File
                                                    </button>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info"></i>
                                                Format: JPG, JPEG, PNG | Maksimal: 5MB | Pastikan gambar jelas dan terbaca
                                            </small>
                                        </div>

                                        <!-- Preview Area -->
                                        <div class="preview-area" id="previewArea" style="display: none;">
                                            <label class="form-label">Preview Bukti Pembayaran:</label>
                                            <div class="preview-container">
                                                <img id="imagePreview" class="img-fluid rounded border">
                                                <div class="preview-overlay">
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="removePreview()">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-info" onclick="document.getElementById('proofFile').click()">
                                                        <i class="fas fa-edit"></i> Ganti
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="file-info mt-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-file"></i> <span id="fileName"></span> 
                                                    (<span id="fileSize"></span>)
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Additional Notes -->
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-comment"></i> Catatan Tambahan (Opsional)
                                            </label>
                                            <textarea name="notes" class="form-control" rows="3" 
                                                      placeholder="Tambahkan catatan jika diperlukan (contoh: waktu transfer, bank pengirim, dll)"></textarea>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-lg btn-block" id="submitBtn">
                                                <i class="fas fa-paper-plane mr-2"></i>
                                                Kirim Bukti Pembayaran
                                            </button>
                                        </div>
                                    </form>
                                    <?php else: ?>
                                    <div class="alert alert-success text-center">
                                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                                        <h5>Pembayaran Sudah Dikonfirmasi</h5>
                                        <p class="mb-0">Transaksi ini sudah lunas. Terima kasih!</p>
                                    </div>
                                    <?php endif; ?>
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
                                        Tips Upload Bukti Pembayaran
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="tip-item">
                                                <i class="fas fa-camera text-primary fa-2x mb-3"></i>
                                                <h6>Foto yang Jelas</h6>
                                                <p class="text-muted small">Pastikan foto bukti transfer jelas dan mudah dibaca. Hindari foto yang buram atau gelap.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="tip-item">
                                                <i class="fas fa-check-circle text-success fa-2x mb-3"></i>
                                                <h6>Informasi Lengkap</h6>
                                                <p class="text-muted small">Pastikan bukti transfer menampilkan nominal, tanggal, waktu, dan nomor rekening tujuan.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="tip-item">
                                                <i class="fas fa-clock text-info fa-2x mb-3"></i>
                                                <h6>Konfirmasi Cepat</h6>
                                                <p class="text-muted small">Tim kami akan memverifikasi pembayaran dalam 1x24 jam setelah upload bukti.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <a href="<?= base_url('user/transactions') ?>" class="btn btn-outline-secondary mr-3">
                                <i class="fas fa-arrow-left"></i> Kembali ke Transaksi
                            </a>
                            <a href="<?= base_url('user/help') ?>" class="btn btn-outline-info">
                                <i class="fas fa-question-circle"></i> Butuh Bantuan?
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

/* Progress Steps */
.checkout-progress {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.step-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.progress-step.completed .step-circle {
    background: #28a745;
    color: white;
}

.progress-step.active .step-circle {
    background: #007bff;
    color: white;
    animation: pulse 2s infinite;
}

.progress-step span {
    font-size: 12px;
    font-weight: 500;
    color: #6c757d;
}

.progress-step.completed span,
.progress-step.active span {
    color: #007bff;
    font-weight: 600;
}

.progress-line {
    width: 100px;
    height: 2px;
    background: #e9ecef;
    margin: 0 20px;
    margin-top: -25px;
}

.progress-line.completed {
    background: #28a745;
}

.progress-line.active {
    background: linear-gradient(90deg, #28a745, #007bff);
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Transaction Details */
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

/* Bank Information */
.bank-details {
    space-y: 15px;
}

.bank-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: white;
    border-radius: 8px;
    border: 1px solid #e3f2fd;
    margin-bottom: 10px;
}

.bank-logo {
    margin-right: 15px;
    font-size: 24px;
}

.bank-info {
    flex: 1;
}

.account-number {
    font-family: 'Courier New', monospace;
    font-weight: bold;
    font-size: 16px;
    color: #007bff;
}

.bank-action {
    margin-left: 10px;
}

/* Upload Area */
.upload-area {
    border: 3px dashed #dee2e6;
    border-radius: 12px;
    padding: 40px 20px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    background: #fafafa;
}

.upload-area:hover {
    border-color: #007bff;
    background: #f8f9ff;
}

.upload-area.drag-over {
    border-color: #28a745;
    background: #f8fff9;
    transform: scale(1.02);
}

.upload-content h5 {
    color: #495057;
    margin-bottom: 10px;
}

/* Preview Area */
.preview-area {
    margin-top: 20px;
}

.preview-container {
    position: relative;
    display: inline-block;
    max-width: 100%;
}

#imagePreview {
    max-height: 300px;
    max-width: 100%;
    border: 2px solid #dee2e6;
}

.preview-overlay {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 5px;
}

.file-info {
    text-align: center;
}

/* Tips Section */
.tip-item {
    text-align: center;
    padding: 20px 10px;
}

.tip-item h6 {
    margin-bottom: 10px;
    font-weight: 600;
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

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
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

/* Submit Button */
#submitBtn {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    transition: all 0.3s ease;
}

#submitBtn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40,167,69,0.3);
}

#submitBtn:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
}

/* Loading Animation */
.loading {
    pointer-events: none;
    opacity: 0.7;
}

.loading::after {
    content: "";
    width: 16px;
    height: 16px;
    margin-left: 10px;
    border: 2px solid transparent;
    border-top: 2px solid #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: inline-block;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .display-4 {
        font-size: 1.8rem;
    }
    
    .checkout-progress {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .progress-line {
        display: none;
    }
    
    .bank-item {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .upload-area {
        padding: 30px 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('proofFile');
    const previewArea = document.getElementById('previewArea');
    const imagePreview = document.getElementById('imagePreview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const submitBtn = document.getElementById('submitBtn');
    
    // Drag and Drop functionality
    if (uploadArea) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });
        
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        uploadArea.addEventListener('drop', handleDrop, false);
        uploadArea.addEventListener('click', () => fileInput.click());
    }
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight(e) {
        uploadArea.classList.add('drag-over');
    }
    
    function unhighlight(e) {
        uploadArea.classList.remove('drag-over');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    }
    
    // File input change
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });
    }
    
    function handleFileSelect(file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Hanya file gambar yang diperbolehkan!');
            return;
        }
        
        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file maksimal 5MB!');
            return;
        }
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            
            uploadArea.style.display = 'none';
            previewArea.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Remove preview
    window.removePreview = function() {
        fileInput.value = '';
        uploadArea.style.display = 'block';
        previewArea.style.display = 'none';
    };
    
    // Copy to clipboard
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show toast notification
            showToast('Nomor rekening berhasil disalin!', 'success');
        }, function(err) {
            console.error('Could not copy text: ', err);
            showToast('Gagal menyalin nomor rekening', 'error');
        });
    };
    
    // Form submission
    const uploadForm = document.getElementById('uploadForm');
    if (uploadForm) {
        uploadForm.addEventListener('submit', function(e) {
            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                alert('Silakan pilih file bukti pembayaran terlebih dahulu!');
                return;
            }
            
            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
            submitBtn.disabled = true;
        });
    }
    
    // Toast notification
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        toast.innerHTML = `
            ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 3000);
    }
});
</script>

<?= $this->endSection() ?>