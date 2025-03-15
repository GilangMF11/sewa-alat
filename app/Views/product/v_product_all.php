<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

       <!-- Header -->
       <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600"><h1 class="text-2xl font-bold text-blue-600">Ngesti Gongso Kemojing</h1></a>
            
            <a href="/login"><button class="hidden md:inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Masuk</button></a>
        </div>
    </header>


    <!-- Search Form -->
    <section class="container mx-auto px-4 py-8">
        <form method="GET" action="<?= base_url('galeri'); ?>" class="flex justify-center mb-8">
            <input type="text" name="search" value="<?= esc($search); ?>" placeholder="Cari produk..." 
                   class="px-4 py-2 w-1/3 border rounded-md">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 ml-2 rounded-md hover:bg-blue-700">Cari</button>
        </form>
    </section>

    <!-- Produk -->
    <section class="container mx-auto px-4 py-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php foreach ($products as $product): ?>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300 cursor-pointer">
            <img src="<?= base_url('show/product/' . esc($product['image'])); ?>" alt="<?= esc($product['name']); ?>" class="w-full h-64 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800"><?= esc($product['name']); ?></h2>
                <p class="text-lg font-bold text-gray-800">Rp <?= number_format($product['price'], 0, ',', '.'); ?> / hari</p>
                <a href="<?= base_url('product/detail/' . $product['id']); ?>" class="block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 text-center mt-4">
                    Detail
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-200 py-8">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <p>&copy; 2023 Ngesti Gongso Kemojing</p>
            <nav class="space-x-6 flex items-center">
                <a href="https://www.instagram.com" target="_blank" class="hover:text-white">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="https://www.facebook.com" target="_blank" class="hover:text-white">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="https://www.tiktok.com" target="_blank" class="hover:text-white">
                    <i class="fab fa-tiktok fa-2x"></i>
                </a>
            </nav>
        </div>
    </footer>

</body>
</html>
