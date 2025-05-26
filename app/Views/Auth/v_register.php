<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - <?= esc($setting['name_web'] ?? 'Ngesti Gongso Kemojing') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('uploads/logo/' . $setting['logo']) ?>" type="image/png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .parallax-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 50%, #1e40af 100%);
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .parallax-bg::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.15"/><circle cx="20" cy="60" r="0.5" fill="white" opacity="0.15"/><circle cx="80" cy="30" r="0.5" fill="white" opacity="0.15"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            z-index: 1;
        }

        .parallax-bg > * {
            position: relative;
            z-index: 2;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .gradient-text {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8, #7C3AED);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 5%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 15%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 25%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            bottom: 5%;
            right: 10%;
            animation-delay: 1s;
        }

        .shape:nth-child(5) {
            width: 70px;
            height: 70px;
            top: 50%;
            left: 5%;
            animation-delay: 3s;
        }

        .form-group {
            opacity: 0;
            animation: slideInLeft 0.6s ease forwards;
        }

        .form-group:nth-child(odd) {
            animation-name: slideInLeft;
        }

        .form-group:nth-child(even) {
            animation-name: slideInRight;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }
        .form-group:nth-child(4) { animation-delay: 0.5s; }
        .form-group:nth-child(5) { animation-delay: 0.6s; }
        .form-group:nth-child(6) { animation-delay: 0.7s; }
        .form-group:nth-child(7) { animation-delay: 0.8s; }

        .logo-container {
            animation: fadeInUp 1s ease 0.2s both;
        }

        .register-card {
            animation: fadeInUp 1s ease 0.4s both;
        }

        .input-field {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }

        .textarea-field {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            resize: none;
        }

        .textarea-field:focus {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }

        .alert-success {
            background: linear-gradient(135deg, #10B981, #059669);
            border: none;
            color: white;
            animation: slideInLeft 0.5s ease;
        }

        .alert-error {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            border: none;
            color: white;
            animation: slideInLeft 0.5s ease;
        }

        .progress-step {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.2);
            color: #3B82F6;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .progress-step.active {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            color: white;
            transform: scale(1.1);
        }

        .password-strength {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 8px;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            background: linear-gradient(90deg, #ef4444, #f59e0b, #10b981);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .glass-card {
                margin: 1rem;
                padding: 2rem 1.5rem;
            }
            
            body {
                padding: 2rem 0;
            }
        }

        @media (max-width: 480px) {
            .glass-card {
                margin: 0.5rem;
                padding: 1.5rem 1rem;
            }
            
            .logo-container h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body class="parallax-bg min-h-screen py-8 overflow-y-auto">
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="w-full max-w-lg mx-auto px-4 relative z-10">
        <!-- Logo Section -->
        <?php if (isset($setting['logo'])): ?>
        <div class="logo-container text-center mb-8">
            <div class="inline-flex items-center space-x-4 mb-4">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30">
                    <img src="<?= base_url('uploads/logo/' . $setting['logo']) ?>" alt="Logo" class="w-10 h-10 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">Ngesti Gongso</h1>
                    <p class="text-blue-100 text-sm">Kemojing</p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Register Card -->
        <div class="glass-card rounded-3xl p-8 register-card">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold gradient-text mb-2">Daftar Sekarang</h2>
                <p class="text-gray-600">Bergabunglah dengan komunitas budaya Jawa</p>
                
                <!-- Progress Indicator -->
                <div class="flex justify-center space-x-2 mt-6">
                    <div class="text-center">
                        <div class="progress-step active">1</div>
                        <span class="text-xs text-gray-500">Info Dasar</span>
                    </div>
                    <div class="text-center">
                        <div class="progress-step">2</div>
                        <span class="text-xs text-gray-500">Akun</span>
                    </div>
                    <div class="text-center">
                        <div class="progress-step">3</div>
                        <span class="text-xs text-gray-500">Selesai</span>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-error rounded-lg p-4 mb-6 text-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>
            
            <?php if (isset($validation)): ?>
            <div class="alert-error rounded-lg p-4 mb-6">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <ul class="list-disc list-inside text-sm">
                    <?php foreach ($validation->getErrors() as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Register Form -->
            <form action="<?= base_url('register') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>
                
                <!-- Name Field -->
                <div class="form-group">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Nama Lengkap
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="name" 
                               class="input-field w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Masukkan nama lengkap Anda"
                               value="<?= old('name') ?>"
                               required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Email
                    </label>
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               class="input-field w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Masukkan email Anda"
                               value="<?= old('email') ?>"
                               required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="input-field w-full pl-12 pr-12 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Buat password yang kuat"
                               onkeyup="checkPasswordStrength()"
                               required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <button type="button" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="fas fa-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    <!-- Password Strength Indicator -->
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2" id="strengthText">Gunakan kombinasi huruf, angka, dan simbol</p>
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock mr-2 text-blue-600"></i>Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="confirm_password" 
                               id="confirmPassword"
                               class="input-field w-full pl-12 pr-12 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Ketik ulang password Anda"
                               onkeyup="checkPasswordMatch()"
                               required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <button type="button" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                onclick="togglePassword('confirmPassword', 'toggleIcon2')">
                            <i class="fas fa-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-2" id="matchText"></p>
                </div>

                <!-- Phone Field -->
                <div class="form-group">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-phone mr-2 text-blue-600"></i>Nomor HP <span class="text-gray-400 text-sm">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <input type="tel" 
                               name="phone" 
                               class="input-field w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               placeholder="Contoh: 08123456789"
                               value="<?= old('phone') ?>">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Address Field -->
                <div class="form-group">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Alamat <span class="text-gray-400 text-sm">(Opsional)</span>
                    </label>
                    <textarea name="address" 
                              rows="3"
                              class="textarea-field w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
                              placeholder="Masukkan alamat lengkap Anda"><?= old('address') ?></textarea>
                </div>

                <!-- Terms and Conditions -->
                <div class="form-group">
                    <div class="flex items-start space-x-3">
                        <input type="checkbox" 
                               id="terms" 
                               name="terms"
                               class="mt-1 w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                               required>
                        <label for="terms" class="text-gray-700 text-sm leading-relaxed">
                            Saya menyetujui <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Syarat & Ketentuan</a> 
                            dan <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Kebijakan Privasi</a> 
                            Ngesti Gongso Kemojing
                        </label>
                    </div>
                </div>

                <!-- Register Button -->
                <div class="form-group">
                    <button type="submit" 
                            id="registerBtn"
                            class="btn-primary w-full text-white py-4 px-6 rounded-xl font-semibold text-lg">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500 font-medium">atau</span>
                </div>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-gray-600 mb-4">
                    Sudah punya akun?
                </p>
                <a href="<?= base_url('login') ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk Sekarang
                </a>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6 pt-6 border-t border-gray-100">
                <a href="<?= base_url('/') ?>" class="inline-flex items-center text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-white/80">
            <p class="text-sm">
                &copy; 2025 Ngesti Gongso Kemojing. All rights reserved.
            </p>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle Password Visibility
        function togglePassword(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password Strength Checker
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let text = '';
            
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 25;
            
            strengthBar.style.width = Math.min(strength, 100) + '%';
            
            if (strength < 50) {
                text = 'Password lemah';
                strengthBar.style.background = '#ef4444';
            } else if (strength < 75) {
                text = 'Password sedang';
                strengthBar.style.background = '#f59e0b';
            } else {
                text = 'Password kuat';
                strengthBar.style.background = '#10b981';
            }
            
            strengthText.textContent = text;
            strengthText.style.color = strength < 50 ? '#ef4444' : strength < 75 ? '#f59e0b' : '#10b981';
        }

        // Password Match Checker
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const matchText = document.getElementById('matchText');
            
            if (confirmPassword === '') {
                matchText.textContent = '';
                return;
            }
            
            if (password === confirmPassword) {
                matchText.textContent = '✓ Password cocok';
                matchText.style.color = '#10b981';
            } else {
                matchText.textContent = '✗ Password tidak cocok';
                matchText.style.color = '#ef4444';
            }
        }

        // Form Animation on Load
        document.addEventListener('DOMContentLoaded', function() {
            // Update progress steps
            const steps = document.querySelectorAll('.progress-step');
            steps[0].classList.add('active');
            
            // Add focus effects
            const inputs = document.querySelectorAll('.input-field, .textarea-field');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    const icon = this.parentElement.querySelector('i');
                    if (icon) icon.style.color = '#3B82F6';
                });
                
                input.addEventListener('blur', function() {
                    const icon = this.parentElement.querySelector('i');
                    if (icon && !this.value) icon.style.color = '#9CA3AF';
                });
            });

            // Auto-hide flash messages
            const alerts = document.querySelectorAll('.alert-success, .alert-error');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transform = 'translateX(100%)';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 7000);
            });
        });

        // Enhanced form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const terms = document.getElementById('terms').checked;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok');
                return;
            }
            
            if (!terms) {
                e.preventDefault();
                alert('Mohon setujui syarat dan ketentuan');
                return;
            }
            
            // Add loading state to button
            const submitBtn = document.getElementById('registerBtn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses Pendaftaran...';
            submitBtn.disabled = true;
        });

        // Phone number formatting
        document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('62')) {
                value = value.substring(2);
            }
            if (value.startsWith('0')) {
                value = value.substring(1);
            }
            if (value.length > 0) {
                value = '0' + value;
            }
            e.target.value = value;
        });
    </script>
</body>

</html>