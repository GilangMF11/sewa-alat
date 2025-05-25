<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-database"></i> Database Backup & Restore</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Backup</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Alert Messages -->
            <div id="alertContainer"></div>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-check"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-ban"></i>
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Backup Section -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header custom-header-bg">
                            <h3 class="card-title">
                                <i class="fas fa-download"></i>
                                Database Backup
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Full Backup -->
                            <div class="mb-4">
                                <h6><i class="fas fa-database"></i> Full Database Backup</h6>
                                <p class="text-muted">Backup seluruh database termasuk semua tabel dan data.</p>
                                <button class="btn btn-success" id="btnFullBackup">
                                    <i class="fas fa-download"></i>
                                    Backup Sekarang
                                </button>
                            </div>

                            <hr>

                            <!-- Selective Backup -->
                            <div class="mb-4">
                                <h6><i class="fas fa-check-square"></i> Selective Table Backup</h6>
                                <p class="text-muted">Pilih tabel tertentu untuk di-backup.</p>
                                <div id="tablesContainer" class="mb-3">
                                    <div class="text-center">
                                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <span class="ml-2">Memuat daftar tabel...</span>
                                    </div>
                                </div>
                                <button class="btn btn-outline-success" id="btnSelectiveBackup" disabled>
                                    <i class="fas fa-check-square"></i>
                                    Backup Tabel Terpilih
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Restore Section -->
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-upload"></i>
                                Database Restore
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
                                Proses restore akan mengganti data yang ada. Pastikan Anda telah membuat backup terlebih dahulu.
                            </div>

                            <form id="restoreForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="backupFile">File Backup (SQL)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="backupFile" name="backup_file" accept=".sql" required>
                                            <label class="custom-file-label" for="backupFile">Pilih file...</label>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Format yang didukung: .sql</small>
                                </div>
                                
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-upload"></i>
                                    Restore Database
                                </button>
                            </form>

                            <!-- Progress Bar -->
                            <div id="restoreProgress" class="mt-3" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" 
                                         role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                        <span class="sr-only">0% Complete</span>
                                    </div>
                                </div>
                                <small class="text-muted">Sedang memproses restore...</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Backup Files List -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list"></i>
                                File Backup Tersedia
                            </h3>
                            <div class="card-tools">
                                <button class="btn btn-tool" id="btnRefreshList" data-toggle="tooltip" title="Refresh">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-file"></i> Nama File</th>
                                        <th><i class="fas fa-weight-hanging"></i> Ukuran</th>
                                        <th><i class="fas fa-calendar"></i> Tanggal</th>
                                        <th><i class="fas fa-cogs"></i> Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="backupsList">
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <div class="spinner-border spinner-border-sm text-info" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <span class="ml-2">Memuat daftar backup...</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const API_BASE = '<?= base_url('backup') ?>';
    
    // Initialize custom file input
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    });

    // SweetAlert2 untuk flash messages
    <?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('success'); ?>',
        timer: 3000,
        showConfirmButton: false
    });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '<?= session()->getFlashdata('error'); ?>',
        timer: 3000,
        showConfirmButton: false
    });
    <?php endif; ?>

    // Show alert message with AdminLTE style
    function showAlert(message, type = 'info') {
        let iconClass = '';
        let alertClass = '';
        
        switch(type) {
            case 'success':
                iconClass = 'fas fa-check';
                alertClass = 'alert-success';
                break;
            case 'error':
            case 'danger':
                iconClass = 'fas fa-ban';
                alertClass = 'alert-danger';
                break;
            case 'warning':
                iconClass = 'fas fa-exclamation-triangle';
                alertClass = 'alert-warning';
                break;
            default:
                iconClass = 'fas fa-info';
                alertClass = 'alert-info';
        }
        
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon ${iconClass}"></i> ${message}
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHtml;
        
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }

    // Load tables for selective backup
    async function loadTables() {
        try {
            const response = await fetch(`${API_BASE}/tables`);
            const result = await response.json();
            
            if (result.status === 'success') {
                let html = '<div class="row">';
                result.data.forEach(table => {
                    html += `
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input table-checkbox" type="checkbox" 
                                       value="${table.table}" id="table_${table.table}">
                                <label class="form-check-label" for="table_${table.table}">
                                    ${table.table} <small class="text-muted">(${table.rows} rows)</small>
                                </label>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                
                document.getElementById('tablesContainer').innerHTML = html;
                document.getElementById('btnSelectiveBackup').disabled = false;
                
                // Enable button when at least one table is selected
                document.querySelectorAll('.table-checkbox').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const anyChecked = document.querySelectorAll('.table-checkbox:checked').length > 0;
                        document.getElementById('btnSelectiveBackup').disabled = !anyChecked;
                    });
                });
            } else {
                document.getElementById('tablesContainer').innerHTML = 
                    '<div class="alert alert-danger"><i class="icon fas fa-ban"></i> Gagal memuat daftar tabel</div>';
            }
        } catch (error) {
            document.getElementById('tablesContainer').innerHTML = 
                '<div class="alert alert-danger"><i class="icon fas fa-ban"></i> Error: ' + error.message + '</div>';
        }
    }

    // Load backup files list
    async function loadBackupsList() {
        try {
            const response = await fetch(`${API_BASE}/list-backups`);
            const result = await response.json();
            
            const tbody = document.getElementById('backupsList');
            
            if (result.status === 'success' && result.data.length > 0) {
                let html = '';
                result.data.forEach(backup => {
                    html += `
                        <tr>
                            <td><i class="fas fa-file-code text-info"></i> ${backup.filename}</td>
                            <td><span class="badge badge-secondary">${backup.size}</span></td>
                            <td><i class="fas fa-clock text-muted"></i> ${backup.date}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button class="btn btn-info" onclick="downloadBackup('${backup.filename}')"
                                            data-toggle="tooltip" title="Download">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-danger" onclick="deleteBackup('${backup.filename}')"
                                            data-toggle="tooltip" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
                tbody.innerHTML = html;
                
                // Initialize tooltips
                $('[data-toggle="tooltip"]').tooltip();
            } else {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted"><i class="fas fa-inbox"></i> Tidak ada file backup</td></tr>';
            }
        } catch (error) {
            document.getElementById('backupsList').innerHTML = 
                '<tr><td colspan="4" class="text-center text-danger"><i class="fas fa-exclamation-triangle"></i> Error: ' + error.message + '</td></tr>';
        }
    }

    // Full backup
    document.getElementById('btnFullBackup').addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        btn.disabled = true;
        
        try {
            const response = await fetch(`${API_BASE}/backup`, { method: 'POST' });
            const result = await response.json();
            
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message,
                    timer: 3000,
                    showConfirmButton: false
                });
                loadBackupsList(); // Refresh list
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: result.message
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message
            });
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });

    // Selective backup
    document.getElementById('btnSelectiveBackup').addEventListener('click', async function() {
        const checkedTables = Array.from(document.querySelectorAll('.table-checkbox:checked'))
                                  .map(cb => cb.value);
        
        if (checkedTables.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Pilih minimal satu tabel'
            });
            return;
        }
        
        const btn = this;
        const originalText = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        btn.disabled = true;
        
        try {
            const formData = new FormData();
            checkedTables.forEach(table => formData.append('tables[]', table));
            
            const response = await fetch(`${API_BASE}/backup-tables`, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message,
                    timer: 3000,
                    showConfirmButton: false
                });
                loadBackupsList(); // Refresh list
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: result.message
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message
            });
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });

    // Perbaikan untuk bagian Restore form di JavaScript
document.getElementById('restoreForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const fileInput = document.getElementById('backupFile');
    const file = fileInput.files[0];
    
    if (!file) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: 'Pilih file backup terlebih dahulu'
        });
        return;
    }
    
    // Validasi ekstensi file di frontend
    const fileName = file.name;
    const fileExtension = fileName.split('.').pop().toLowerCase();
    
    console.log('File Info:', {
        name: fileName,
        extension: fileExtension,
        size: file.size,
        type: file.type
    });
    
    if (fileExtension !== 'sql') {
        Swal.fire({
            icon: 'error',
            title: 'File Tidak Valid!',
            text: `File harus berekstensi .sql (Anda memilih: .${fileExtension})`
        });
        return;
    }
    
    // Validasi ukuran file (max 50MB)
    const maxSize = 50 * 1024 * 1024; // 50MB in bytes
    if (file.size > maxSize) {
        Swal.fire({
            icon: 'error',
            title: 'File Terlalu Besar!',
            text: 'Ukuran file maksimal 50MB'
        });
        return;
    }
    
    const result = await Swal.fire({
        title: 'Konfirmasi Restore',
        text: 'Apakah Anda yakin ingin melakukan restore? Data yang ada akan diganti!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Restore!',
        cancelButtonText: 'Batal'
    });
    
    if (!result.isConfirmed) return;
    
    const formData = new FormData();
    formData.append('backup_file', file);
    
    const progressDiv = document.getElementById('restoreProgress');
    const progressBar = progressDiv.querySelector('.progress-bar');
    
    progressDiv.style.display = 'block';
    progressBar.style.width = '50%';
    progressBar.setAttribute('aria-valuenow', '50');
    
    try {
        console.log('Sending restore request...');
        
        const response = await fetch(`${API_BASE}/restore`, {
            method: 'POST',
            body: formData
        });
        
        console.log('Response status:', response.status);
        
        const result = await response.json();
        console.log('Response data:', result);
        
        progressBar.style.width = '100%';
        progressBar.setAttribute('aria-valuenow', '100');
        
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: result.message,
                timer: 3000,
                showConfirmButton: false
            });
            this.reset();
            $('.custom-file-label').removeClass("selected").html("Pilih file...");
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: result.message || 'Terjadi kesalahan saat restore'
            });
        }
    } catch (error) {
        console.error('Restore error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Terjadi kesalahan: ' + error.message
        });
    } finally {
        setTimeout(() => {
            progressDiv.style.display = 'none';
            progressBar.style.width = '0%';
            progressBar.setAttribute('aria-valuenow', '0');
        }, 1000);
    }
});

// Tambahkan validasi real-time saat file dipilih
document.getElementById('backupFile').addEventListener('change', function() {
    const file = this.files[0];
    const label = this.nextElementSibling;
    
    if (file) {
        const fileName = file.name;
        const fileExtension = fileName.split('.').pop().toLowerCase();
        
        if (fileExtension === 'sql') {
            label.classList.add("selected");
            label.classList.remove("text-danger");
            label.classList.add("text-success");
            label.innerHTML = `✓ ${fileName}`;
        } else {
            label.classList.add("selected");
            label.classList.add("text-danger");
            label.classList.remove("text-success");
            label.innerHTML = `✗ ${fileName} (harus .sql)`;
        }
    } else {
        label.classList.remove("selected", "text-danger", "text-success");
        label.innerHTML = "Pilih file...";
    }
});

    // Download backup
    window.downloadBackup = function(filename) {
        window.location.href = `${API_BASE}/download/${filename}`;
    };

    // Delete backup
    window.deleteBackup = async function(filename) {
        const result = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus file ${filename}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });
        
        if (!result.isConfirmed) return;
        
        try {
            const response = await fetch(`${API_BASE}/delete/${filename}`, {
                method: 'DELETE'
            });
            const result = await response.json();
            
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message,
                    timer: 3000,
                    showConfirmButton: false
                });
                loadBackupsList(); // Refresh list
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: result.message
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message
            });
        }
    };

    // Refresh backup list
    document.getElementById('btnRefreshList').addEventListener('click', function() {
        const icon = this.querySelector('i');
        icon.classList.add('fa-spin');
        
        loadBackupsList().finally(() => {
            setTimeout(() => {
                icon.classList.remove('fa-spin');
            }, 500);
        });
    });

    // Initialize page
    loadTables();
    loadBackupsList();
});
</script>

<style>
.custom-header-bg {
    background-color: #4caf50 !important;
    color: white !important;
}

.card-primary .card-header {
    background-color: #4caf50;
    border-color: #4caf50;
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
}

.form-check-input:checked {
    background-color: #4caf50;
    border-color: #4caf50;
}

.btn-group-sm > .btn, .btn-sm {
    padding: .25rem .5rem;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: .2rem;
}

.table td {
    vertical-align: middle;
}

.progress {
    height: 1.5rem;
}

.alert {
    border-radius: .375rem;
}
</style>
<?= $this->endSection() ?>