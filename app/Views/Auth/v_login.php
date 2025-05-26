<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - <?= esc($setting['name_web'] ?? 'Ngesti Gongso Kemojing') ?></title>
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

        @keyframes pulse-ring {
            0% {
                transform: scale(0.7);
                opacity: 1;
            }
            80%, 100% {
                transform: scale(2.2);
                opacity: 0;
            }
        }

        .parallax-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 50%, #1e40af 100%);
            position: relative;
            overflow: hidden;
        }

        .parallax-bg::before {
            content: '';
            position: absolute;
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
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
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
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 20%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            bottom: 10%;
            right: 10%;
            animation-delay: 1s;
        }

        .form-group {
            animation: slideInLeft 0.6s ease forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.4s; }
        .form-group:nth-child(3) { animation-delay: 0.6s; }
        .form-group:nth-child(4) { animation-delay: 0.8s; }

        .logo-container {
            animation: fadeInUp 1s ease 0.2s both;
        }

        .login-card {
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

        .input-icon {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            color: white;
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

        .checkbox-custom {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #3B82F6;
            border-radius: 4px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-custom:checked {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            border-color: #1D4ED8;
        }

        .checkbox-custom:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .glass-card {
                margin: 1rem;
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body class="parallax-bg min-h-screen flex items-center justify-center">
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="w-full max-w-md mx-auto px-4">
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

        <!-- Login Card -->
        <div class="glass-card rounded-3xl p-8 login-card">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold gradient-text mb-2">Selamat Datang</h2>
                <p class="text-gray-600">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-success rounded-lg p-4 mb-6 text-center">
                <i class="fas fa-check-circle mr-2"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-error rounded-lg p-4 mb-6 text-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= base_url('login') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>
                
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
                               placeholder="Masukkan password Anda"
                               required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <button type="button" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-group flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="checkbox-custom mr-3">
                        <label for="remember" class="text-gray-700 font-medium cursor-pointer">
                            Ingat Saya
                        </label>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                        Lupa Password?
                    </a>
                </div>

                <!-- Login Button -->
                <div class="form-group">
                    <button type="submit" class="btn-primary w-full text-white py-4 px-6 rounded-xl font-semibold text-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk Sekarang
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

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-gray-600 mb-4">
                    Belum punya akun?
                </p>
                <a href="<?= base_url('register') ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Sekarang
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
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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

        // Form Animation on Load
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus effects
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('i').style.color = '#3B82F6';
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.querySelector('i').style.color = '#9CA3AF';
                    }
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
                }, 5000);
            });
        });

        // Enhanced form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang diperlukan');
                return;
            }
            
            // Add loading state to button
            const submitBtn = document.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            submitBtn.disabled = true;
        });
    </script>
</body>

</html>