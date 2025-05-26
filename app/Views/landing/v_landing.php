
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($setting['name_web'] ?? 'Ngesti Gongso Kemojing') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('uploads/logo/' . $setting['logo']) ?>" type="image/png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes infinite-carousel {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
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

        .carousel-track {
            display: flex;
            gap: 2rem;
            animation: infinite-carousel 40s linear infinite;
        }

        .carousel-track:hover {
            animation-play-state: paused;
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
            position: relative;
        }

        .parallax::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(29, 78, 216, 0.8), rgba(79, 70, 229, 0.6));
            z-index: 1;
        }

        .parallax > * {
            position: relative;
            z-index: 2;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            border-radius: 50%;
            padding: 18px;
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            animation: float 3s ease-in-out infinite;
        }

        .whatsapp-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: #25D366;
            border-radius: 50%;
            animation: pulse-ring 2s infinite;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
            box-shadow: 0 12px 35px rgba(37, 211, 102, 0.6);
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
        }

        .dropdown-menu a:hover {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
            color: white;
            transform: translateX(5px);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            transition: transform 0.4s ease;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background: linear-gradient(135deg, #ffffff, #e5e7eb);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
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

        .testimonial-card {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
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

        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Enhanced hero text animation */
        .hero-title {
            animation: fadeInUp 1s ease 0.5s both;
        }

        .hero-subtitle {
            animation: fadeInUp 1s ease 0.7s both;
        }

        .hero-button {
            animation: fadeInUp 1s ease 0.9s both;
        }

        /* Product price styling */
        .price-tag {
            background: linear-gradient(135deg, #059669, #10B981);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
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

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <!-- Navigation -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 backdrop-blur-md shadow-xl fixed w-full z-50 transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30">
                    <span class="text-white font-bold text-xl">N</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">Ngesti Gongso Kemojing</h1>
            </div>
            
            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-8 items-center">
                <a href="#" class="nav-link text-white hover:text-blue-200 font-medium">Home</a>
                <a href="#tentang" class="nav-link text-white hover:text-blue-200 font-medium">Tentang Kami</a>
                <a href="#galeri" class="nav-link text-white hover:text-blue-200 font-medium">Galeri</a>
                <a href="#kontak" class="nav-link text-white hover:text-blue-200 font-medium">Kontak</a>
            </nav>

            <!-- User Menu / Login -->
            <div class="flex items-center space-x-4">
                <?php if (session()->get('isLoggedIn')): ?>
                <div class="relative">
                    <button id="userDropdownToggle" class="text-3xl text-white hover:text-blue-200 transition-colors focus:outline-none">
                        <i class="fas fa-user-circle"></i>
                    </button>
                    <div id="userDropdownMenu" class="dropdown-menu min-w-48">
                        <a href="<?= base_url('/dashboard') ?>" class="block px-6 py-3 text-gray-800 hover:bg-gray-100 font-medium">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                        <a href="<?= base_url('/cart') ?>" class="block px-6 py-3 text-gray-800 hover:bg-gray-100 font-medium">
                            <i class="fas fa-shopping-cart mr-2"></i>Keranjang
                        </a>
                        <a href="<?= base_url('/logout') ?>" class="block px-6 py-3 text-red-600 hover:bg-gray-100 font-medium">
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

                <!-- Mobile Menu Toggle -->
                <button class="md:hidden text-2xl text-white" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <nav class="mobile-menu md:hidden bg-blue-700 shadow-lg absolute top-full left-0 w-full" id="mobile-menu">
            <div class="px-6 py-4 space-y-4">
                <a href="#" class="block text-white hover:text-blue-200 font-medium py-2">Home</a>
                <a href="#tentang" class="block text-white hover:text-blue-200 font-medium py-2">Tentang Kami</a>
                <a href="#galeri" class="block text-white hover:text-blue-200 font-medium py-2">Galeri</a>
                <a href="#kontak" class="block text-white hover:text-blue-200 font-medium py-2">Kontak</a>
                <?php if (!session()->get('isLoggedIn')): ?>
                <a href="<?= base_url('/login') ?>" class="block">
                    <button class="bg-white text-blue-600 py-2 px-6 rounded-full font-semibold w-full">
                        Masuk
                    </button>
                </a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Hero Section with Enhanced Parallax -->
    <?php $bgImage = base_url('show/image/' . ($setting['background'] ?? '')); ?>
    <section class="parallax h-screen flex items-center justify-center relative overflow-hidden"
        style="background-image: url('<?= $bgImage ?>');">
        
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full animate-ping"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-blue-400/20 rounded-full animation-delay-1000 animate-ping"></div>
            <div class="absolute bottom-40 left-1/4 w-12 h-12 bg-purple-400/20 rounded-full animation-delay-2000 animate-ping"></div>
        </div>

        <div class="text-center glass-card p-12 rounded-3xl shadow-2xl max-w-4xl mx-6">
            <h2 class="hero-title text-4xl md:text-6xl font-bold gradient-text mb-6 leading-tight">
                Pusat Sewa Alat<br>Budaya Jawa
            </h2>
            <p class="hero-subtitle text-lg md:text-xl text-gray-700 mb-8 max-w-2xl mx-auto leading-relaxed">
                Menawarkan berbagai alat budaya Jawa berkualitas tinggi untuk keperluan acara, upacara, dan edukasi dengan pelayanan terbaik.
            </p>
            <div class="hero-button space-y-4 md:space-y-0 md:space-x-4 md:flex md:justify-center">
                <a href="#galeri" class="btn-primary text-white py-4 px-8 rounded-full font-semibold text-lg inline-block">
                    <i class="fas fa-eye mr-2"></i>Lihat Koleksi
                </a>
                <a href="#tentang" class="bg-white text-gray-800 py-4 px-8 rounded-full font-semibold text-lg inline-block border-2 border-gray-200 hover:border-blue-500 transition-all">
                    <i class="fas fa-info-circle mr-2"></i>Pelajari Lebih
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 text-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="section-fade-in">
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-blue-100">Alat Tersedia</div>
                </div>
                <div class="section-fade-in">
                    <div class="text-4xl font-bold mb-2">1000+</div>
                    <div class="text-blue-100">Pelanggan Puas</div>
                </div>
                <div class="section-fade-in">
                    <div class="text-4xl font-bold mb-2">5+</div>
                    <div class="text-blue-100">Tahun Pengalaman</div>
                </div>
                <div class="section-fade-in">
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <div class="text-blue-100">Layanan Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang" class="container mx-auto px-8 py-20">
        <div class="text-center section-fade-in">
            <h3 class="text-4xl md:text-5xl font-bold gradient-text mb-8">Tentang Kami</h3>
            <div class="max-w-4xl mx-auto">
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed mb-8">
                    Ngesti Gongso Kemojing hadir untuk melestarikan budaya Jawa melalui penyewaan alat tradisional berkualitas tinggi. 
                    Kami berkomitmen untuk menjaga kualitas, memberikan kemudahan akses bagi masyarakat, dan melestarikan warisan budaya Indonesia.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-xl mb-2">Kualitas Terjamin</h4>
                        <p class="text-gray-600">Semua alat dirawat dengan standar tinggi</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-green-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-xl mb-2">Pelayanan Cepat</h4>
                        <p class="text-gray-600">Proses booking dan pengiriman yang efisien</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-heart text-purple-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-xl mb-2">Budaya Lestari</h4>
                        <p class="text-gray-600">Melestarikan warisan budaya Jawa</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Produk -->
    <section id="galeri" class="bg-gradient-to-b from-gray-50 to-white py-20">
        <div class="container mx-auto px-6">
            <div class="text-center section-fade-in mb-16">
                <h3 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Galeri Alat Budaya</h3>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Koleksi lengkap alat budaya Jawa tradisional untuk berbagai keperluan acara dan upacara
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php $i = 0; foreach ($products as $product): ?>
                <?php if ($i < 8): ?>
                <div class="product-card section-fade-in cursor-pointer group" 
                     onclick="window.location.href='<?= base_url('product/detail/' . $product['id']) ?>'">
                    <div class="relative overflow-hidden">
                        <img src="<?= base_url('show/product/' . $product['image']) ?>" 
                             alt="<?= esc($product['name']) ?>" 
                             class="w-full h-56 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                Tersedia
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="font-semibold text-xl text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">
                            <?= esc($product['name']) ?>
                        </h4>
                        <div class="flex items-center justify-between">
                            <span class="price-tag text-sm">
                                Mulai Rp<?= number_format($product['price'], 0, ',', '.') ?>
                            </span>
                            <div class="text-blue-500 group-hover:text-blue-700 transition-colors">
                                <i class="fas fa-arrow-right text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php $i++; endforeach; ?>
            </div>

            <div class="mt-16 text-center section-fade-in">
                <a href="/galeri" class="btn-primary text-white py-4 px-8 rounded-full font-semibold text-lg inline-block">
                    <i class="fas fa-th mr-2"></i>Lihat Semua Koleksi
                </a>
            </div>
        </div>
    </section>

    <!-- Testimoni Pelanggan -->
    <section class="bg-gradient-to-r from-blue-50 to-purple-50 py-20 overflow-hidden">
        <div class="container mx-auto px-8 text-center">
            <div class="section-fade-in mb-16">
                <h3 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Testimoni Pelanggan</h3>
                <p class="text-xl text-gray-600">Kepuasan pelanggan adalah prioritas utama kami</p>
            </div>
            
            <div class="relative overflow-hidden">
                <div class="carousel-track">
                    <div class="flex space-x-8">
                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Layanan sangat memuaskan dan alat yang disewakan berkualitas tinggi! Sangat membantu acara pernikahan adat kami."</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    R
                                </div>
                                <div>
                                    <h5 class="font-semibold">Rani Sari</h5>
                                    <p class="text-gray-500 text-sm">Pengantin</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Sangat membantu dalam acara budaya sekolah kami. Alat lengkap dan terawat dengan baik."</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    B
                                </div>
                                <div>
                                    <h5 class="font-semibold">Budi Pratama</h5>
                                    <p class="text-gray-500 text-sm">Guru Seni Budaya</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Proses peminjaman cepat dan alat yang diterima bersih serta terawat. Pelayanan sangat profesional!"</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    D
                                </div>
                                <div>
                                    <h5 class="font-semibold">Dewi Anggraini</h5>
                                    <p class="text-gray-500 text-sm">Event Organizer</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Pengantaran tepat waktu dan pelayanan sangat ramah. Harga juga sangat terjangkau untuk kualitas yang didapat."</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    R
                                </div>
                                <div>
                                    <h5 class="font-semibold">Rian Teguh</h5>
                                    <p class="text-gray-500 text-sm">Ketua Komunitas</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Kami sangat puas dengan layanan Ngesti Gongso Kemojing! Koleksi alat lengkap dan autentik."</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-red-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    J
                                </div>
                                <div>
                                    <h5 class="font-semibold">Joko Widodo</h5>
                                    <p class="text-gray-500 text-sm">Seniman Tradisional</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Alat gamelan yang disewakan masih bagus dan suaranya jernih. Sangat cocok untuk pertunjukan di sekolah."</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    S
                                </div>
                                <div>
                                    <h5 class="font-semibold">Sri Mulyani</h5>
                                    <p class="text-gray-500 text-sm">Kepala Sekolah</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Kostum tradisional yang kami sewa untuk acara wayang kulit sangat bagus dan bersih. Terima kasih!"</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-teal-400 to-green-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    A
                                </div>
                                <div>
                                    <h5 class="font-semibold">Ahmad Santoso</h5>
                                    <p class="text-gray-500 text-sm">Dalang</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Pelayanan yang luar biasa! Staff sangat membantu dalam memberikan konsultasi untuk acara budaya kami."</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-pink-400 to-red-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    L
                                </div>
                                <div>
                                    <h5 class="font-semibold">Lestari Handayani</h5>
                                    <p class="text-gray-500 text-sm">Koordinator Acara</p>
                                </div>
                            </div>
                        </div>

                        <!-- Duplicate set for seamless loop -->
                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Layanan sangat memuaskan dan alat yang disewakan berkualitas tinggi! Sangat membantu acara pernikahan adat kami."</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    R
                                </div>
                                <div>
                                    <h5 class="font-semibold">Rani Sari</h5>
                                    <p class="text-gray-500 text-sm">Pengantin</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-card w-80 flex-shrink-0">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-lg">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-6 italic">"Sangat membantu dalam acara budaya sekolah kami. Alat lengkap dan terawat dengan baik."</p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-400 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                    B
                                </div>
                                <div>
                                    <h5 class="font-semibold">Budi Pratama</h5>
                                    <p class="text-gray-500 text-sm">Guru Seni Budaya</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="bg-white py-20">
        <div class="container mx-auto px-6">
            <div class="text-center section-fade-in mb-16">
                <h3 class="text-4xl md:text-5xl font-bold gradient-text mb-4">Hubungi Kami</h3>
                <p class="text-xl text-gray-600">Siap membantu kebutuhan alat budaya Anda</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <!-- Contact Info -->
                <div class="section-fade-in">
                    <div class="glass-card p-8 rounded-3xl">
                        <h4 class="text-2xl font-bold mb-6 gradient-text">Informasi Kontak</h4>
                        <div class="space-y-6">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-blue-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Alamat</h5>
                                    <p class="text-gray-600">Jl. Budaya Jawa No. 123, Yogyakarta</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-phone text-green-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Telepon</h5>
                                    <p class="text-gray-600">+62 821-8886-5677</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-envelope text-purple-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Email</h5>
                                    <p class="text-gray-600">info@ngestikemojing.com</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-clock text-red-600"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Jam Operasional</h5>
                                    <p class="text-gray-600">Senin - Sabtu: 08:00 - 17:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="section-fade-in">
                    <div class="glass-card p-8 rounded-3xl">
                        <h4 class="text-2xl font-bold mb-6 gradient-text">Kirim Pesan</h4>
                        <form class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Masukkan nama Anda">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Masukkan email Anda">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Pesan</label>
                                <textarea rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all resize-none" placeholder="Tulis pesan Anda..."></textarea>
                            </div>
                            <button type="submit" class="btn-primary w-full text-white py-3 px-6 rounded-xl font-semibold">
                                <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-16">
        <div class="container mx-auto px-8">
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
                        <a href="<?= esc($setting['facebook'] ?? '#') ?>" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="<?= esc($setting['twitter'] ?? '#') ?>" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="<?= esc($setting['instagram'] ?? '#') ?>" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#tentang" class="text-gray-300 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#galeri" class="text-gray-300 hover:text-white transition-colors">Galeri</a></li>
                        <li><a href="#kontak" class="text-gray-300 hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="/login" class="text-gray-300 hover:text-white transition-colors">Login</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Sewa Gamelan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Kostum Tradisional</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Dekorasi Adat</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Konsultasi Acara</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Delivery Service</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center">
                <p class="text-gray-300">
                    &copy; 2025 Ngesti Gongso Kemojing. All rights reserved. | 
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a> | 
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // User dropdown toggle
            const toggle = document.getElementById('userDropdownToggle');
            const menu = document.getElementById('userDropdownMenu');

            if (toggle && menu) {
                document.addEventListener('click', function (e) {
                    if (toggle.contains(e.target)) {
                        menu.classList.toggle('show');
                    } else if (!menu.contains(e.target)) {
                        menu.classList.remove('show');
                    }
                });
            }

            // Mobile menu toggle
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('active');
                    const icon = menuToggle.querySelector('i');
                    if (mobileMenu.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Intersection Observer for fade-in animations
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

            // Observe all elements with section-fade-in class
            document.querySelectorAll('.section-fade-in').forEach(el => {
                observer.observe(el);
            });

            // Header scroll effect
            let lastScrollTop = 0;
            const header = document.querySelector('header');
            
            window.addEventListener('scroll', function() {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop) {
                    // Scrolling down
                    header.style.transform = 'translateY(-100%)';
                } else {
                    // Scrolling up
                    header.style.transform = 'translateY(0)';
                }
                
                // Keep consistent background
                header.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-blue-800');
                
                lastScrollTop = scrollTop;
            });

            // Add padding top to body to account for fixed header
            document.body.style.paddingTop = header.offsetHeight + 'px';
        });
    </script>

</body>
</html>