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
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-4xl font-bold text-blue-700">Ngesti Gongso Kemojing</h1>
            <nav class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-blue-700 transition duration-200">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-700 transition duration-200">Tentang Kami</a>
                <a href="#" class="text-gray-700 hover:text-blue-700 transition duration-200">Galeri</a>
                <a href="#" class="text-gray-700 hover:text-blue-700 transition duration-200">Kontak</a>
            </nav>
            <a href="<?php echo base_url('/login'); ?>">
                <button
                    class="hidden md:inline-block bg-blue-700 text-white py-2 px-6 rounded-lg hover:bg-blue-800 transition duration-300">Masuk</button>
            </a>
        </div>
    </header>

    <!-- Hero Section with Parallax -->
    <?php
    $bgImage = base_url('show/image/' . ($setting['background'] ?? 'default.jpg'));
?>
    <section class="parallax h-screen flex items-center justify-center"
        style="background-image: url('<?= $bgImage ?>');">
        <div class="text-center bg-white bg-opacity-90 p-12 rounded-lg shadow-lg">
            <h2 class="text-6xl font-bold text-blue-700 mb-6 drop-shadow">Pusat Sewa Alat Budaya Jawa</h2>
            <p class="text-lg text-gray-800 mb-6">Menawarkan berbagai alat budaya Jawa untuk keperluan acara, upacara,
                dan edukasi.</p>
            <a href="#galeri"
                class="bg-blue-700 text-white py-3 px-8 rounded-lg hover:bg-blue-800 transition duration-300">Lihat
                Koleksi</a>
        </div>
    </section>


    <!-- Tentang Kami -->
    <section class="container mx-auto px-8 py-20 text-center">
        <h3 class="text-4xl font-semibold text-blue-700 mb-6">Tentang Kami</h3>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto">Ngesti Gongso Kemojing hadir untuk melestarikan budaya Jawa
            melalui penyewaan alat tradisional. Kami berkomitmen untuk menjaga kualitas dan memberikan kemudahan akses
            bagi masyarakat.</p>
    </section>

    <!-- Galeri Produk -->
    <section id="galeri" class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <h3 class="text-4xl font-semibold text-center text-blue-700 mb-8">Galeri Alat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <?php $i = 0; foreach ($products as $product): ?>
                <?php if ($i < 8): ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 cursor-pointer"
                    onclick="window.location.href='<?= base_url('product/detail/' . $product['id']) ?>'">
                    <img src="<?= base_url('show/product/' . $product['image']) ?>" alt="<?= esc($product['name']) ?>"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="font-semibold text-lg text-gray-800"><?= esc($product['name']) ?></h4>
                        <p class="text-gray-500">Mulai dari Rp<?= number_format($product['price'], 0, ',', '.') ?></p>
                        <a href="https://wa.me/62<?= esc($setting['phone'] ?? '82188865677') ?>"
                            class="whatsapp-button">
                            <i class="fab fa-whatsapp text-3xl"></i>
                        </a>

                    </div>
                </div>
                <?php endif; ?>
                <?php $i++; endforeach; ?>
            </div>

            <div class="mt-8 text-center">
                <a href="/galeri"
                    class="bg-blue-700 text-white py-3 px-8 rounded-lg hover:bg-blue-800 transition duration-300 inline-block">
                    Lihat Semua
                </a>
            </div>
        </div>
    </section>

    <!-- Testimoni Pelanggan (Infinite Running Card) -->
    <section class="bg-gray-100 py-16 overflow-hidden">
        <div class="container mx-auto px-8 text-center">
            <h3 class="text-4xl font-semibold text-blue-700 mb-8">Testimoni Pelanggan</h3>
            <div class="relative overflow-hidden">
                <div class="carousel-track">
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
                            <p class="text-gray-600">"Proses peminjaman cepat dan alat yang diterima bersih dan
                                terawat."</p>
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
    <footer class="bg-blue-700 text-white py-12">
        <div class="container mx-auto px-8 text-center">
            <div class="flex justify-center space-x-8 mb-6">
                <a href="<?= esc($setting['facebook'] ?? '#') ?>" class="text-white text-xl"><i
                        class="fab fa-facebook"></i></a>
                <a href="<?= esc($setting['twitter'] ?? '#') ?>" class="text-white text-xl"><i
                        class="fab fa-twitter"></i></a>
                <a href="<?= esc($setting['instagram'] ?? '#') ?>" class="text-white text-xl"><i
                        class="fab fa-instagram"></i></a>

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