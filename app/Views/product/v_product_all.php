<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Produk - Ngesti Gongso Kemojing</title>
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

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            transition: transform 0.4s ease;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-card > * {
            position: relative;
            z-index: 2;
        }

        .price-badge {
            background: linear-gradient(135deg, #059669, #10B981);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
        }

        .warning-badge {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.75rem;
            animation: float 2s ease-in-out infinite;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
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

        .search-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 3rem;
            animation: slideInDown 0.8s ease;
        }

        .search-input {
            border: 2px solid #E5E7EB;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
            background: #F9FAFB;
        }

        .search-input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: white;
            outline: none;
        }

        .search-btn {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            border-radius: 15px;
            padding: 1rem 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .search-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .search-btn:hover::before {
            left: 100%;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
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

        .section-fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .section-fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.15"/><circle cx="20" cy="60" r="0.5" fill="white" opacity="0.15"/><circle cx="80" cy="30" r="0.5" fill="white" opacity="0.15"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            z-index: 1;
        }

        .hero-section > * {
            position: relative;
            z-index: 2;
        }

        .floating-shapes {
            position: absolute;
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
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 30%;
            left: 70%;
            animation-delay: 4s;
        }

        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .filter-chip {
            background: white;
            border: 2px solid #E5E7EB;
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-chip:hover, .filter-chip.active {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }

        .no-products {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .no-products i {
            font-size: 4rem;
            color: #9CA3AF;
            margin-bottom: 1rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .search-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .filter-chips {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .filter-chip {
                flex-shrink: 0;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50">

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
                <a href="<?= base_url('/products') ?>" class="text-blue-200 font-semibold">
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

    <!-- Hero Section -->
    <section class="hero-section py-20 relative">
        <!-- Floating Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Koleksi Alat Budaya Jawa
            </h1>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Temukan berbagai alat tradisional berkualitas tinggi untuk keperluan acara, upacara, dan edukasi budaya Jawa
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 text-white">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Kualitas Terjamin
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 text-white">
                    <i class="fas fa-truck mr-2"></i>
                    Pengiriman Cepat
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 text-white">
                    <i class="fas fa-headset mr-2"></i>
                    Support 24/7
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="container mx-auto px-4 -mt-10 relative z-10">
        <div class="search-container">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold gradient-text mb-2">Cari Produk</h2>
                <p class="text-gray-600">Temukan alat budaya yang Anda butuhkan</p>
            </div>
            
            <form method="GET" action="<?= base_url('galeri'); ?>" class="flex flex-col md:flex-row gap-4 max-w-2xl mx-auto">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           name="search" 
                           value="<?= esc($search); ?>" 
                           placeholder="Cari produk (gamelan, kostum, dekorasi...)"
                           class="search-input w-full pl-12 pr-4">
                </div>
                <button type="submit" class="search-btn text-white font-semibold">
                    <i class="fas fa-search mr-2"></i>
                    Cari Produk
                </button>
            </form>

            <?php if (!empty($search)): ?>
            <div class="mt-4 text-center">
                <span class="inline-flex items-center bg-blue-100 text-blue-800 px-4 py-2 rounded-full">
                    <i class="fas fa-search mr-2"></i>
                    Hasil pencarian untuk: <strong class="ml-1">"<?= esc($search) ?>"</strong>
                    <a href="<?= base_url('galeri') ?>" class="ml-3 text-blue-600 hover:text-blue-800">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Filter Categories -->
    <section class="container mx-auto px-4 mb-8">
        <div class="filter-chips section-fade-in">
            <div class="filter-chip active" data-category="all">
                <i class="fas fa-th mr-2"></i>Semua Produk
            </div>
            <div class="filter-chip" data-category="gamelan">
                <i class="fas fa-music mr-2"></i>Gamelan
            </div>
            <div class="filter-chip" data-category="kostum">
                <i class="fas fa-tshirt mr-2"></i>Kostum
            </div>
            <div class="filter-chip" data-category="dekorasi">
                <i class="fas fa-palette mr-2"></i>Dekorasi
            </div>
            <div class="filter-chip" data-category="aksesoris">
                <i class="fas fa-gem mr-2"></i>Aksesoris
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="container mx-auto px-4 pb-16">
        <?php if (empty($products)): ?>
            <div class="no-products section-fade-in">
                <i class="fas fa-search"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Produk Tidak Ditemukan</h3>
                <p class="text-gray-500 mb-4">
                    <?php if (!empty($search)): ?>
                        Tidak ada produk yang cocok dengan pencarian "<strong><?= esc($search) ?></strong>"
                    <?php else: ?>
                        Belum ada produk yang tersedia saat ini
                    <?php endif; ?>
                </p>
                <div class="space-x-4">
                    <?php if (!empty($search)): ?>
                    <a href="<?= base_url('galeri') ?>" class="btn-primary inline-block text-white py-3 px-6 rounded-xl font-semibold">
                        <i class="fas fa-th mr-2"></i>
                        Lihat Semua Produk
                    </a>
                    <?php endif; ?>
                    <a href="<?= base_url('/') ?>" class="inline-block bg-gray-500 text-white py-3 px-6 rounded-xl font-semibold hover:bg-gray-600 transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center mb-8 section-fade-in">
                <h2 class="text-3xl font-bold gradient-text mb-2">
                    <?php if (!empty($search)): ?>
                        Hasil Pencarian
                    <?php else: ?>
                        Koleksi Produk Kami
                    <?php endif; ?>
                </h2>
                <p class="text-gray-600">
                    Menampilkan <?= count($products) ?> produk
                    <?php if (!empty($search)): ?>
                        untuk "<?= esc($search) ?>"
                    <?php endif; ?>
                </p>
            </div>

            <?php if (!empty($products)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $index => $product): ?>
                    <div class="product-card bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                        <img src="<?= base_url('show/product/' . esc($product['image'])); ?>"
                             alt="<?= esc($product['name']); ?>"
                             class="w-full h-48 object-cover rounded mb-4">

                        <h2 class="text-lg font-semibold mb-1"><?= esc($product['name']); ?></h2>
                        <p class="text-gray-600 mb-2 text-sm"><?= esc($product['description']); ?></p>

                        <div class="flex justify-between items-center">
                            <span class="text-green-600 font-bold text-base">
                                Rp <?= number_format($product['price'], 0, ',', '.'); ?>
                            </span>
                            <span class="text-sm text-gray-500">/ hari</span>
                        </div>

                        <p class="text-xs text-yellow-600 mt-2 font-medium">
                            * Belum termasuk ongkir
                        </p>

                        <a href="<?= base_url('product/detail/' . $product['id']); ?>"
                           class="block mt-4 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center text-gray-600 py-20">
                <i class="fas fa-box-open text-4xl mb-4"></i>
                <p class="text-lg font-semibold">Tidak ada produk ditemukan</p>
            </div>
        <?php endif; ?>
    </div>

            <!-- Load More atau Pagination bisa ditambahkan di sini -->
            <div class="text-center mt-12 section-fade-in">
                <div class="bg-white rounded-2xl p-8 shadow-lg max-w-md mx-auto">
                    <i class="fas fa-info-circle text-blue-500 text-3xl mb-4"></i>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Butuh Bantuan?</h4>
                    <p class="text-gray-600 mb-4">Tim customer service kami siap membantu Anda memilih produk yang tepat</p>
                    <a href="<?= base_url('/contact') ?>" class="btn-primary inline-block text-white py-3 px-6 rounded-xl font-semibold">
                        <i class="fas fa-headset mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl">N</span>
                        </div>
                        <h3 class="text-2xl font-bold">Ngesti Gongso Kemojing</h3>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Melestarikan budaya Jawa melalui penyediaan alat tradisional berkualitas tinggi 
                        untuk berbagai keperluan acara dan upacara adat.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-900 transition-colors">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="<?= base_url('/') ?>" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="<?= base_url('/products') ?>" class="text-gray-300 hover:text-white transition-colors">Produk</a></li>
                        <li><a href="<?= base_url('/about') ?>" class="text-gray-300 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="<?= base_url('/contact') ?>" class="text-gray-300 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kategori</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Gamelan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Kostum Tradisional</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Dekorasi Adat</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Aksesoris</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center">
                <p class="text-gray-300">
                    &copy; 2025 Ngesti Gongso Kemojing. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6282188865677?text=Halo,%20saya%20tertarik%20dengan%20layanan%20sewa%20alat%20budaya%20Anda" 
       class="whatsapp-button group" 
       target="_blank"
       title="Chat WhatsApp">
        <i class="fab fa-whatsapp text-2xl relative z-10"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</body>
</html>