<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f8f9fc 0%, #e9ecef 100%);
        min-height: calc(100vh - 60px);
    }
    
    .content-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 0 0 20px 20px;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-header {
        padding: 1.5rem;
        text-align: center;
    }
    
    .page-title {
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
        font-size: 2.2rem;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .profile-icon {
        font-size: 2.5rem;
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .alert {
        border: none;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
    }
    
    .alert-success {
        background: linear-gradient(45deg, rgba(40, 167, 69, 0.1), rgba(25, 135, 84, 0.1));
        border-left: 4px solid #28a745;
        color: #155724;
    }
    
    .alert-danger {
        background: linear-gradient(45deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.1));
        border-left: 4px solid #dc3545;
        color: #721c24;
    }
    
    .alert ul {
        margin: 0;
        padding-left: 1.5rem;
    }
    
    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .profile-header {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
        position: relative;
        overflow: hidden;
    }
    
    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .profile-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .profile-body {
        padding: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(248, 249, 250, 0.8);
        backdrop-filter: blur(5px);
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-1px);
    }
    
    .form-control:hover {
        border-color: #b8c5ea;
        background: rgba(255, 255, 255, 0.9);
    }
    
    .form-control[readonly] {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-color: #dee2e6;
        color: #6c757d;
        cursor: not-allowed;
    }
    
    .input-group {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 5;
        font-size: 1.1rem;
    }
    
    .form-control.with-icon {
        padding-left: 45px;
    }
    
    .save-btn {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
    }
    
    .save-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(40, 167, 69, 0.4);
        color: white;
    }
    
    .save-btn:active {
        transform: translateY(0);
    }
    
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% { transform: translate(0, 0px); }
        50% { transform: translate(0, -5px); }
        100% { transform: translate(0, 0px); }
    }
    
    .form-group:nth-child(even) .form-control {
        animation-delay: 0.1s;
    }
    
    .form-group:nth-child(odd) .form-control {
        animation-delay: 0.2s;
    }
    
    .profile-stats {
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: center;
        border: 1px solid rgba(102, 126, 234, 0.2);
    }
    
    .stats-text {
        color: #495057;
        font-size: 0.9rem;
        margin: 0;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .page-title {
            font-size: 2rem;
        }
        
        .profile-body {
            padding: 1.5rem;
        }
        
        .profile-header {
            padding: 1.2rem 1.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
            flex-direction: column;
            gap: 0.3rem;
        }
        
        .profile-icon {
            font-size: 2rem;
        }
        
        .profile-body {
            padding: 1rem;
        }
        
        .profile-header {
            padding: 1rem 1.2rem;
        }
        
        .profile-header h5 {
            font-size: 1.2rem;
        }
        
        .form-control {
            padding: 10px 12px;
        }
        
        .form-control.with-icon {
            padding-left: 40px;
        }
        
        .input-icon {
            left: 12px;
            font-size: 1rem;
        }
        
        .save-btn {
            width: 100%;
            justify-content: center;
            padding: 15px 20px;
            font-size: 1rem;
        }
    }
    
    @media (max-width: 576px) {
        .content-header {
            border-radius: 0;
            margin-bottom: 1rem;
        }
        
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.6rem;
        }
        
        .profile-card {
            border-radius: 15px;
            margin: 0 -15px 1rem -15px;
        }
        
        .alert {
            margin: 0 -15px 1rem -15px;
            border-radius: 0;
        }
        
        .profile-stats {
            margin: 0 -15px 1rem -15px;
            border-radius: 0;
        }
    }
    
    /* Loading Animation */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-user-circle profile-icon"></i>
                    Profil Saya
                </h1>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success floating">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger floating">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mt-2">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="profile-stats floating">
                <p class="stats-text">
                    <i class="fas fa-info-circle me-1"></i>
                    Kelola informasi profil Anda untuk keamanan dan kenyamanan berbelanja
                </p>
            </div>

            <div class="profile-card">
                <div class="profile-header">
                    <h5>
                        <i class="fas fa-edit"></i>
                        Edit Profil Pengguna
                    </h5>
                </div>
                <div class="profile-body">
                    <form method="post" action="<?= base_url('profile/update') ?>" id="profileForm">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user"></i>
                                Nama Lengkap
                            </label>
                            <div class="input-group">
                                <i class="input-icon fas fa-user"></i>
                                <input type="text" 
                                       name="name" 
                                       class="form-control with-icon" 
                                       value="<?= esc($user['name']) ?>" 
                                       placeholder="Masukkan nama lengkap Anda"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-envelope"></i>
                                Email Address
                            </label>
                            <div class="input-group">
                                <i class="input-icon fas fa-envelope"></i>
                                <input type="email" 
                                       name="email" 
                                       class="form-control with-icon" 
                                       value="<?= esc($user['email']) ?>" 
                                       placeholder="Email tidak dapat diubah"
                                       readonly 
                                       required>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-lock me-1"></i>
                                Email tidak dapat diubah untuk keamanan akun
                            </small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-phone"></i>
                                Nomor Telepon
                            </label>
                            <div class="input-group">
                                <i class="input-icon fas fa-phone"></i>
                                <input type="text" 
                                       name="phone" 
                                       class="form-control with-icon" 
                                       value="<?= esc($user['phone']) ?>"
                                       placeholder="Contoh: 081234567890">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Alamat Lengkap
                            </label>
                            <div class="input-group">
                                <i class="input-icon fas fa-map-marker-alt"></i>
                                <input type="text" 
                                       name="address" 
                                       class="form-control with-icon" 
                                       value="<?= esc($user['address']) ?>"
                                       placeholder="Masukkan alamat lengkap Anda">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-key"></i>
                                Password Baru
                            </label>
                            <div class="input-group">
                                <i class="input-icon fas fa-key"></i>
                                <input type="password" 
                                       name="password" 
                                       class="form-control with-icon" 
                                       placeholder="Kosongkan jika tidak ingin mengubah password">
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Minimal 8 karakter untuk keamanan yang lebih baik
                            </small>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="save-btn">
                                <i class="fas fa-save"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('profileForm');
        const submitBtn = form.querySelector('.save-btn');
        
        // Form submission with loading state
        form.addEventListener('submit', function(e) {
            // Add loading state
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;
            
            // Show loading toast
            Swal.fire({
                title: 'Menyimpan...',
                html: 'Sedang memproses perubahan profil Anda',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
        });
        
        // Enhanced focus effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.form-group').classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.closest('.form-group').classList.remove('focused');
            });
            
            // Real-time validation feedback
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('has-value');
                } else {
                    this.classList.remove('has-value');
                }
            });
        });
        
        // Phone number formatting
        const phoneInput = document.querySelector('input[name="phone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                // Remove non-digits
                let value = this.value.replace(/\D/g, '');
                
                // Limit to reasonable length
                if (value.length > 15) {
                    value = value.substring(0, 15);
                }
                
                this.value = value;
            });
        }
        
        // Password strength indicator
        const passwordInput = document.querySelector('input[name="password"]');
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = calculatePasswordStrength(password);
                
                // You can add visual feedback here
                if (password.length > 0) {
                    showPasswordStrength(strength);
                }
            });
        }
        
        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            return strength;
        }
        
        function showPasswordStrength(strength) {
            const colors = ['#dc3545', '#fd7e14', '#ffc107', '#28a745', '#20c997'];
            const labels = ['Sangat Lemah', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
            
            // You can implement visual feedback here
            console.log('Password strength:', labels[strength - 1] || 'Tidak valid');
        }
        
        // Auto-save draft (optional feature)
        let saveTimeout;
        inputs.forEach(input => {
            if (input.name !== 'password') {
                input.addEventListener('input', function() {
                    clearTimeout(saveTimeout);
                    saveTimeout = setTimeout(() => {
                        // Save draft to localStorage
                        const formData = new FormData(form);
                        const data = Object.fromEntries(formData);
                        delete data.password; // Don't save password
                        localStorage.setItem('profileDraft', JSON.stringify(data));
                    }, 1000);
                });
            }
        });
        
        // Load draft on page load
        const draft = localStorage.getItem('profileDraft');
        if (draft) {
            try {
                const data = JSON.parse(draft);
                Object.keys(data).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input && input.name !== 'email') {
                        input.value = data[key];
                        if (data[key]) input.classList.add('has-value');
                    }
                });
            } catch (e) {
                console.log('Could not load draft');
            }
        }
        
        // Clear draft on successful submission
        form.addEventListener('submit', function() {
            setTimeout(() => {
                localStorage.removeItem('profileDraft');
            }, 2000);
        });
    });

    // Custom styles for focused state
    const style = document.createElement('style');
    style.textContent = `
        .form-group.focused .form-control {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }
        
        .form-group.focused .form-label {
            color: #667eea;
        }
        
        .form-group.focused .input-icon {
            color: #667eea;
        }
        
        .form-control.has-value {
            background: rgba(255, 255, 255, 0.95);
            border-color: #28a745;
        }
        
        .form-control.has-value:focus {
            border-color: #667eea;
        }
    `;
    document.head.appendChild(style);
</script>

<?= $this->endSection() ?>