<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome CDN for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <link rel="icon" href="<?= base_url('uploads/logo/' . $setting['logo']) ?>" type="image/png">
    <style>
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

    .blink-red {
        color: red;
        animation: blink-animation 1s steps(2, start) infinite;
        font-weight: bold;
    }

    @keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        margin-top: 0.5rem;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 999;
    }

    .dropdown-menu.show {
        display: block;
    }
    </style>
</head>


<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600">
                <h1 class="text-2xl font-bold text-blue-600">Ngesti Gongso Kemojing</h1>
            </a>

            <?php if (session()->get('isLoggedIn')): ?>
            <div class="relative">
                <button id="userDropdownToggle" class="text-3xl text-blue-700 focus:outline-none">
                    <i class="fas fa-user-circle"></i>
                </button>
                <div id="userDropdownMenu" class="dropdown-menu">
                    <a href="<?= base_url('/dashboard') ?>"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dashboard</a>
                    <a href="<?= base_url('/cart') ?>"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Keranjang</a>
                    <a href="<?= base_url('/logout') ?>"
                        class="block px-4 py-2 text-red-600 hover:bg-gray-100">Logout</a>
                </div>
            </div>
            <?php else: ?>
            <a href="<?= base_url('/login') ?>">
                <button
                    class="hidden md:inline-block bg-blue-700 text-white py-2 px-6 rounded-lg hover:bg-blue-800 transition duration-300">
                    Masuk
                </button>
            </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Detail Produk -->
    <section class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Gambar Produk -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img src="<?= base_url('show/product/' . esc($product['image'])); ?>"
                    alt="<?= esc($product['name']); ?>" class="w-full h-96 object-cover">
            </div>
            <!-- Informasi Produk -->
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-3xl font-bold text-blue-600 mb-4"><?= esc($product['name']); ?></h2>
                <p class="text-gray-700 mb-6"><?= esc($product['description']); ?></p>
                <p class="text-2xl font-bold text-gray-800 mb-6">Rp
                    <?= number_format($product['price'], 0, ',', '.'); ?> / hari</p>
                <p class="blink-red">* Belum Termasuk Ongkir</p>


                <!-- Input Jumlah -->
                <div class="mb-6">
                    <label for="quantity" class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                    <div class="flex items-center">
                        <button id="decrease"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-l hover:bg-gray-400 focus:outline-none">-</button>
                        <input id="quantity" type="number" value="1" min="1"
                            class="w-16 text-center border-t border-b border-gray-300 focus:outline-none">
                        <button id="increase"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-r hover:bg-gray-400 focus:outline-none">+</button>
                    </div>
                </div>

                <!-- Tombol Pesan -->
                <a href="https://wa.me/6282188865677?text=Halo%2C+saya+ingin+memesan+<?= urlencode($product['name']); ?>+dengan+jumlah+1"
                    id="buy-now-link" target="_blank"
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



    <!-- Tombol WhatsApp Mengambang -->
    <a href="https://wa.me/6282188865677" class="whatsapp-button">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

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
        addToCartLink.href =
            `<?= base_url('cart/add/' . $product['id']); ?>?quantity=${quantity}&redirect_url=https://wa.me/6282188865677?text=${encodeURIComponent(message)}`;
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

<script>
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>