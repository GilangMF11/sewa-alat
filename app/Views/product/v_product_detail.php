<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Ngesti Gongso Kemojing</h1>
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Galeri</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Kontak</a>
            </nav>
            <button class="hidden md:inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Sewa Sekarang</button>
        </div>
    </header>

    <!-- Detail Produk -->
    <section class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Gambar Produk -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="https://picsum.photos/600/400" alt="Gamelan" class="w-full h-96 object-cover">
            </div>
            <!-- Informasi Produk -->
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-3xl font-bold text-blue-600 mb-4">Gamelan Set</h2>
                <p class="text-gray-700 mb-6">Alat musik tradisional Jawa yang terdiri dari berbagai instrumen. Cocok untuk acara budaya, upacara adat, atau edukasi.</p>
                <p class="text-2xl font-bold text-gray-800 mb-6">Rp500.000 / hari</p>

                <!-- Input Jumlah -->
                <div class="mb-6">
                    <label for="quantity" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                    <div class="flex items-center">
                        <button id="decrease" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-l hover:bg-gray-400 focus:outline-none">-</button>
                        <input id="quantity" type="number" value="1" min="1" class="w-16 text-center border-t border-b border-gray-300 focus:outline-none">
                        <button id="increase" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-r hover:bg-gray-400 focus:outline-none">+</button>
                    </div>
                </div>

                <!-- Tombol Beli -->
                <a href="https://wa.me/6282188865677?text=Halo%2C+saya+ingin+memesan+Gamelan+Set+dengan+jumlah+1" 
                   id="buy-now-link" 
                   target="_blank" 
                   class="block bg-blue-600 text-white py-3 px-6 rounded hover:bg-blue-700 text-center transition duration-300">
                    Beli Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- <footer class="bg-gray-800 text-gray-200 py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2023 Ngesti Gongso Kemojing. All rights reserved.</p>
        </div>
    </footer> -->

    <!-- JavaScript -->
    <script>
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const quantityInput = document.getElementById('quantity');
        const buyNowLink = document.getElementById('buy-now-link');

        // Update WhatsApp link based on quantity
        function updateWhatsAppLink() {
            const quantity = quantityInput.value;
            const message = `Halo, saya ingin memesan Gamelan Set dengan jumlah ${quantity}`;
            buyNowLink.href = `https://wa.me/6282188865677?text=${encodeURIComponent(message)}`;
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
