<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?= esc($product['name']); ?> | Ngesti Gongso Kemojing</title>
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
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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

        .navbar {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8, #7C3AED);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .product-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            transition: transform 0.4s ease;
            background: linear-gradient(45deg, #f8fafc, #e2e8f0);
        }

        .product-image:hover {
            transform: scale(1.05);
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

        .btn-success {
            background: linear-gradient(135deg, #10B981, #059669);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-success:hover::before {
            left: 100%;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        }

        .quantity-control {
            background: white;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .quantity-btn {
            background: #F9FAFB;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: #3B82F6;
            color: white;
        }

        .price-badge {
            background: linear-gradient(135deg, #059669, #10B981);
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1.5rem;
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
            display: inline-block;
        }

        .warning-badge {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            animation: float 2s ease-in-out infinite;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            margin-top: 0.5rem;
            background-color: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            z-index: 999;
            overflow: hidden;
            backdrop-filter: blur(20px);
        }

        .dropdown-menu.show {
            display: block;
            animation: fadeInUp 0.3s ease;
        }

        .dropdown-menu a {
            transition: all 0.3s ease;
            padding: 12px 20px;
        }

        .dropdown-menu a:hover {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            color: white;
            transform: translateX(5px);
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #3B82F6;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .section-fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .section-fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .login-required {
            background: linear-gradient(135deg, #FEF3C7, #FDE68A);
            border: 2px solid #F59E0B;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navigation -->
    <header class="navbar shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="<?= base_url('/') ?>" class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30">
                    <span class="text-white font-bold text-xl">N</span>
                </div>
                <h1 class="text-2xl font-bold text-white">Ngesti Gongso Kemojing</h1>
            </a>

            <nav class="hidden md:flex space-x-6">
                <a href="<?= base_url('/') ?>" class="text-white hover:text-blue-200 transition-colors">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                <a href="<?= base_url('/galeri') ?>" class="text-white hover:text-blue-200 transition-colors">
                    <i class="fas fa-th mr-2"></i>Produk
                </a>
            </nav>

            <?php if (session()->get('isLoggedIn')): ?>
            <div class="relative">
                <button id="userDropdownToggle" class="text-3xl text-white hover:text-blue-200 transition-colors focus:outline-none">
                    <i class="fas fa-user-circle"></i>
                </button>
                <div id="userDropdownMenu" class="dropdown-menu min-w-48">
                    <a href="<?= base_url('/dashboard') ?>" class="block text-gray-800 hover:bg-gray-100 font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="<?= base_url('/cart') ?>" class="block text-gray-800 hover:bg-gray-100 font-medium">
                        <i class="fas fa-shopping-cart mr-2"></i>Keranjang
                    </a>
                    <a href="<?= base_url('/logout') ?>" class="block text-red-600 hover:bg-gray-100 font-medium">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
            <?php else: ?>
            <a href="<?= base_url('/login') ?>">
                <button class="bg-white text-blue-600 py-2 px-6 rounded-full font-semibold hover:bg-blue-50 hover:shadow-lg transition-all">
                    <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                </button>
            </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-3">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="<?= base_url('/') ?>" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-home"></i> Beranda
                </a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <a href="<?= base_url('/galeri') ?>" class="text-blue-600 hover:text-blue-800">Produk</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="text-gray-600"><?= esc($product['name']); ?></span>
            </nav>
        </div>
    </div>

    <!-- Detail Produk -->
    <section class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Gambar Produk -->
            <div class="section-fade-in">
                <div class="product-card">
                    <div class="product-image p-8">
                        <img src="<?= base_url('show/product/' . esc($product['image'])); ?>"
                             alt="<?= esc($product['name']); ?>" 
                             class="w-full h-96 object-cover rounded-lg">
                    </div>
                </div>
                
                <!-- Feature Cards -->
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h6 class="font-semibold text-gray-800">Kualitas Terjamin</h6>
                        <p class="text-gray-600 text-sm">Alat terawat dengan baik</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h6 class="font-semibold text-gray-800">Pengiriman Cepat</h6>
                        <p class="text-gray-600 text-sm">Siap antar ke lokasi</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="section-fade-in">
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    <div class="mb-6">
                        <h1 class="text-4xl font-bold gradient-text mb-4"><?= esc($product['name']); ?></h1>
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="price-badge">
                                Rp <?= number_format($product['price'], 0, ',', '.'); ?>
                            </span>
                            <span class="text-gray-500 font-medium">/ hari</span>
                        </div>
                        <span class="warning-badge">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Belum Termasuk Ongkir
                        </span>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">
                            <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                            Deskripsi Produk
                        </h3>
                        <p class="text-gray-700 leading-relaxed"><?= esc($product['description']); ?></p>
                    </div>

                    <!-- Input Jumlah -->
                    <div class="mb-8">
                        <label for="quantity" class="block text-gray-700 font-semibold mb-3">
                            <i class="fas fa-sort-numeric-up text-blue-600 mr-2"></i>
                            Jumlah yang Disewa
                        </label>
                        <div class="quantity-control flex items-center w-32">
                            <button id="decrease" class="quantity-btn px-4 py-3 font-bold focus:outline-none">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input id="quantity" type="number" value="1" min="1"
                                   class="w-16 text-center py-3 border-0 focus:outline-none font-semibold">
                            <button id="increase" class="quantity-btn px-4 py-3 font-bold focus:outline-none">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="space-y-4">
                        <!-- Tombol Pesan (tanpa WhatsApp) -->
                        <button class="btn-primary w-full text-white py-4 px-6 rounded-xl font-semibold text-lg shadow-lg">
                            <i class="fas fa-shopping-bag mr-2"></i>
                            Pesan Sekarang
                        </button>

                        <!-- Tombol Keranjang -->
                        <?php if (session()->get('isLoggedIn')): ?>
                            <a href="<?= base_url('cart/add/' . $product['id']); ?>?quantity=1"
                               id="add-to-cart-link"
                               class="btn-success block text-white py-4 px-6 rounded-xl font-semibold text-lg text-center shadow-lg">
                                <i class="fas fa-cart-plus mr-2"></i>
                                Tambah ke Keranjang
                            </a>
                        <?php else: ?>
                            <div class="login-required text-center">
                                <div class="flex items-center justify-center mb-3">
                                    <i class="fas fa-lock text-yellow-600 text-2xl mr-3"></i>
                                    <div>
                                        <h6 class="font-semibold text-yellow-800">Login Diperlukan</h6>
                                        <p class="text-yellow-700 text-sm">Silakan login terlebih dahulu untuk menambah ke keranjang</p>
                                    </div>
                                </div>
                                <a href="<?= base_url('/login') ?>" 
                                   class="btn-primary inline-block text-white py-3 px-6 rounded-xl font-semibold">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Login Sekarang
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Info Tambahan -->
                    <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl">
                        <h6 class="font-semibold text-gray-800 mb-3">
                            <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                            Informasi Penting
                        </h6>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Harga yang tertera adalah per hari sewa
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Ongkos kirim dihitung berdasarkan lokasi
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Alat sudah dicek kondisinya sebelum dikirim
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                Customer service siap membantu 24/7
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Serupa -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold gradient-text mb-4">Produk Lainnya</h3>
                <p class="text-gray-600">Lihat koleksi alat budaya Jawa lainnya</p>
            </div>
            
            <div class="text-center">
                <a href="<?= base_url('/galeri') ?>" 
                   class="btn-primary inline-block text-white py-4 px-8 rounded-xl font-semibold text-lg">
                    <i class="fas fa-th mr-2"></i>
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <div class="flex items-center justify-center space-x-3 mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-xl">N</span>
                </div>
                <h3 class="text-2xl font-bold">Ngesti Gongso Kemojing</h3>
            </div>
            <p class="text-gray-300 mb-6">
                Melestarikan budaya Jawa melalui penyediaan alat tradisional berkualitas tinggi
            </p>
            <div class="flex justify-center space-x-4 mb-6">
                <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
            <p class="text-gray-400">
                &copy; 2025 Ngesti Gongso Kemojing. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // User dropdown toggle
            const toggle = document.getElementById('userDropdownToggle');
            const menu = document.getElementById('userDropdownMenu');

            if (toggle && menu) {
                document.addEventListener('click', function(e) {
                    if (toggle.contains(e.target)) {
                        menu.classList.toggle('show');
                    } else if (!menu.contains(e.target)) {
                        menu.classList.remove('show');
                    }
                });
            }

            // Quantity controls
            const decreaseButton = document.getElementById('decrease');
            const increaseButton = document.getElementById('increase');
            const quantityInput = document.getElementById('quantity');
            const addToCartLink = document.getElementById('add-to-cart-link');

            function updateCartLink() {
                const quantity = quantityInput.value;
                if (addToCartLink) {
                    const baseUrl = addToCartLink.href.split('?')[0];
                    addToCartLink.href = `${baseUrl}?quantity=${quantity}`;
                }
            }

            decreaseButton.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantity--;
                    quantityInput.value = quantity;
                    updateCartLink();
                }
            });

            increaseButton.addEventListener('click', () => {
                let quantity = parseInt(quantityInput.value);
                quantity++;
                quantityInput.value = quantity;
                updateCartLink();
            });

            quantityInput.addEventListener('input', updateCartLink);

            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.section-fade-in').forEach(el => {
                observer.observe(el);
            });
        });
    </script>

</body>
</html>