<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngesti Gongso Kemojing</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Menambahkan FontAwesome untuk ikon -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        @keyframes infinite-carousel {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .carousel-track {
            display: flex;
            gap: 1rem;
            animation: infinite-carousel 30s linear infinite;
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }

        /* Tombol WhatsApp mengambang */
        .whatsapp-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <!-- Navigation -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-blue-600">Ngesti Gongso Kemojing</h1>
            <nav class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Tentang Kami</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Galeri</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Kontak</a>
            </nav>
            <a href="<?php echo base_url('/login'); ?>"><button
            class="hidden md:inline-block bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-200">Masuk</button></a>
            <button class="md:hidden text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Hero Section with Parallax -->
    <section class="parallax h-screen flex items-center justify-center" style="background-image: url('https://picsum.photos/1920/1080');">
        <div class="text-center bg-white bg-opacity-75 p-12 rounded-lg shadow-lg">
            <h2 class="text-5xl font-bold text-blue-600 mb-6">Pusat Sewa Alat Budaya Jawa</h2>
            <p class="text-lg text-gray-700 mb-6">Menawarkan berbagai alat budaya Jawa untuk keperluan acara, upacara, dan edukasi.</p>
            <a href="#galeri" class="bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-700 transition duration-200">Lihat Koleksi</a>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="container mx-auto px-8 py-20 text-center">
        <h3 class="text-4xl font-semibold text-blue-600 mb-6">Tentang Kami</h3>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto">Ngesti Gongso Kemojing hadir untuk melestarikan budaya Jawa melalui penyewaan alat tradisional. Kami berkomitmen untuk menjaga kualitas dan memberikan kemudahan akses bagi masyarakat.</p>
    </section>

    <!-- Galeri Produk -->
    <section id="galeri" class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <h3 class="text-4xl font-semibold text-center text-blue-600 mb-8">Galeri Alat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Loop untuk menampilkan produk -->
            <?php $i = 0; foreach ($products as $product): ?>
            <?php if ($i < 8): ?>
            <div class="bg-white shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 cursor-pointer"
                onclick="window.location.href='<?= base_url('product/detail/' . $product['id']) ?>'">
                <!-- Menampilkan gambar produk -->
                <img src="<?= base_url('show/product/' . $product['image']) ?>" alt="<?= esc($product['name']) ?>"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <!-- Menampilkan nama dan harga produk -->
                    <h4 class="font-semibold text-lg text-gray-800"><?= esc($product['name']) ?></h4>
                    <p class="text-gray-500">Mulai dari Rp<?= number_format($product['price'], 0, ',', '.') ?></p>
                    <!-- Tombol Pesan -->
                    <a href="https://wa.me/6282188865677?text=Halo,%20saya%20tertarik%20untuk%20memesan%20produk%20<?= urlencode($product['name']) ?>"
                        class="mt-4 w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 text-center inline-block transition duration-200">
                        Pesan
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <?php $i++; endforeach; ?>
        </div>

        <!-- Tombol Lihat Semua -->
        <div class="mt-8 text-center">
            <a href="/galeri" class="bg-blue-600 text-white py-3 px-8 rounded-lg hover:bg-blue-700 transition duration-200 inline-block">
                Lihat Semua
            </a>
        </div>

        
</section>

    <!-- Testimoni Pelanggan (Infinite Running Card) -->
    <section class="bg-gray-100 py-16 overflow-hidden">
        <div class="container mx-auto px-8 text-center">
            <h3 class="text-4xl font-semibold text-blue-600 mb-8">Testimoni Pelanggan</h3>
            <div class="relative overflow-hidden">
                <div class="carousel-track">
                    <!-- Duplicate each card set to create a seamless loop -->
                    <div class="flex space-x-8">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Layanan sangat memuaskan dan alat yang disewakan berkualitas!"</p>
                            <h5 class="mt-4 font-semibold">Rani S.</h5>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Sangat membantu dalam acara budaya kami."</p>
                            <h5 class="mt-4 font-semibold">Budi P.</h5>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Proses peminjaman cepat dan alat yang diterima bersih dan terawat."</p>
                            <h5 class="mt-4 font-semibold">Dewi A.</h5>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Pengantaran tepat waktu dan pelayanan sangat ramah."</p>
                            <h5 class="mt-4 font-semibold">Rian T.</h5>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Kami sangat puas dengan layanan Ngesti Gongso Kemojing!"</p>
                            <h5 class="mt-4 font-semibold">Joko W.</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-12">
        <div class="container mx-auto px-8 text-center">
            <div class="flex justify-center space-x-8 mb-6">
                <a href="https://facebook.com" class="text-white text-xl"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com" class="text-white text-xl"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" class="text-white text-xl"><i class="fab fa-instagram"></i></a>
                <a href="https://linkedin.com" class="text-white text-xl"><i class="fab fa-linkedin"></i></a>
            </div>
            <p>&copy; 2025 Ngesti Gongso Kemojing. All rights reserved.</p>
        </div>
    </footer>

    <!-- Tombol WhatsApp Mengambang -->
    <a href="https://wa.me/6282188865677" class="whatsapp-button">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

</body>

</html>
