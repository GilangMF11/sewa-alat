<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome CDN for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600"><h1 class="text-2xl font-bold text-blue-600">Ngesti Gongso Kemojing</h1></a>
            
            <a href="/login"><button class="hidden md:inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Masuk</button></a>
        </div>
    </header>

    <!-- Detail Produk -->
    <section class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Gambar Produk -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="<?= base_url('show/product/' . esc($product['image'])); ?>" alt="<?= esc($product['name']); ?>" class="w-full h-96 object-cover">
            </div>
            <!-- Informasi Produk -->
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-3xl font-bold text-blue-600 mb-4"><?= esc($product['name']); ?></h2>
                <p class="text-gray-700 mb-6"><?= esc($product['description']); ?></p>
                <p class="text-2xl font-bold text-gray-800 mb-6">Rp <?= number_format($product['price'], 0, ',', '.'); ?> / hari</p>

                <!-- Input Jumlah -->
                <div class="mb-6">
                    <label for="quantity" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                    <div class="flex items-center">
                        <button id="decrease" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-l hover:bg-gray-400 focus:outline-none">-</button>
                        <input id="quantity" type="number" value="1" min="1" class="w-16 text-center border-t border-b border-gray-300 focus:outline-none">
                        <button id="increase" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-r hover:bg-gray-400 focus:outline-none">+</button>
                    </div>
                </div>

                <!-- Tombol Pesan -->
                <a href="https://wa.me/6282188865677?text=Halo%2C+saya+ingin+memesan+<?= urlencode($product['name']); ?>+dengan+jumlah+1" 
                   id="buy-now-link" 
                   target="_blank" 
                   class="block bg-blue-600 text-white py-3 px-6 rounded hover:bg-blue-700 text-center transition duration-300 mb-4">
                    Pesan
                </a>

                <!-- Tombol Keranjang -->
                <a href="<?= base_url('cart/add/' . $product['id']); ?>?quantity=1&redirect_url=https://wa.me/6282188865677?text=Halo%2C+saya+ingin+memesan+<?= urlencode($product['name']); ?>+dengan+jumlah+1" 
                   id="add-to-cart-link" 
                   class="block bg-green-600 text-white py-3 px-6 rounded hover:bg-green-700 text-center transition duration-300">
                    Keranjang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-200 py-8">
        <!-- Map Frame (Embed Google Map) -->
        <div class="mt-8 p-4"> <!-- Added padding here -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12698.439728430933!2d110.36052061275562!3d-7.5319518034405775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a03375e3d12b7%3A0x8ffca3326b8d0f99!2sKebun%20Raya%20Bogor!5e0!3m2!1sid!2sid!4v1674078033585!5m2!1sid!2sid"
                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p>&copy; 2023 Ngesti Gongso Kemojing</p>
            <nav class="space-x-6 flex items-center">
                <!-- Sosial Media Links -->
                <a href="https://www.instagram.com" target="_blank" class="hover:text-white">
                    <i class="fab fa-instagram fa-2x"></i> <!-- Instagram Icon -->
                </a>
                <a href="https://www.facebook.com" target="_blank" class="hover:text-white">
                    <i class="fab fa-facebook fa-2x"></i> <!-- Facebook Icon -->
                </a>
                <a href="https://www.tiktok.com" target="_blank" class="hover:text-white">
                    <i class="fab fa-tiktok fa-2x"></i> <!-- TikTok Icon -->
                </a>
            </nav>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const quantityInput = document.getElementById('quantity');
        const buyNowLink = document.getElementById('buy-now-link');
        const addToCartLink = document.getElementById('add-to-cart-link');

        // Update WhatsApp link based on quantity
        function updateWhatsAppLink() {
            const quantity = quantityInput.value;
            const message = `Halo, saya ingin memesan <?= urlencode($product['name']); ?> dengan jumlah ${quantity}`;
            buyNowLink.href = `https://wa.me/6282188865677?text=${encodeURIComponent(message)}`;
            addToCartLink.href = `<?= base_url('cart/add/' . $product['id']); ?>?quantity=${quantity}&redirect_url=https://wa.me/6282188865677?text=${encodeURIComponent(message)}`;
        }

        // Event Listeners
        decreaseButton.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
                updateWhatsAppLink();
            }
        });

        increaseButton.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;
            updateWhatsAppLink();
        });

        quantityInput.addEventListener('input', updateWhatsAppLink);
    </script>

</body>

</html>
