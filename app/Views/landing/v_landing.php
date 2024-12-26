<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngesti Gongso Kemojing</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
           <style>
        @keyframes infinite-carousel {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }

        .carousel-track {
            display: flex;
            gap: 1rem;
            animation: infinite-carousel 30s linear infinite;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

    <!-- Navigation -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Ngesti Gongso Kemojing</h1>
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Tentang Kami</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Galeri</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Kontak</a>
            </nav>
            <button class="hidden md:inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Sewa Sekarang</button>
            <button class="md:hidden text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('https://picsum.photos/1920/1080');">
        <div class="text-center bg-white bg-opacity-75 p-10 rounded">
            <h2 class="text-4xl font-bold text-blue-600 mb-4">Pusat Sewa Alat Budaya Jawa</h2>
            <p class="text-gray-700 mb-6">Menawarkan berbagai alat budaya Jawa untuk keperluan acara, upacara, dan edukasi.</p>
            <a href="#galeri" class="bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700">Lihat Koleksi</a>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="container mx-auto px-4 py-16 text-center">
        <h3 class="text-3xl font-semibold text-blue-600 mb-4">Tentang Kami</h3>
        <p class="text-gray-700 max-w-2xl mx-auto">Ngesti Gongso Kemojing hadir untuk melestarikan budaya Jawa melalui penyewaan alat tradisional. Kami berkomitmen untuk menjaga kualitas dan memberikan kemudahan akses bagi masyarakat.</p>
    </section>

    <!-- Galeri Produk -->
<section id="galeri" class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <h3 class="text-3xl font-semibold text-center text-blue-600 mb-8">Galeri Alat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Card Produk -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://picsum.photos/400/300" alt="Gamelan" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-semibold text-lg">Gamelan</h4>
                    <p class="text-gray-500">Mulai dari Rp500.000</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Detail</button>
                </div>
            </div>
            <!-- Tambahkan lebih banyak card sesuai produk -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://picsum.photos/400/300" alt="Kebaya" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-semibold text-lg">Kebaya</h4>
                    <p class="text-gray-500">Mulai dari Rp150.000</p>
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Detail</button>
                </div>
            </div>
            <!-- Anda dapat menambahkan lebih banyak card di sini -->
        </div>
        <!-- Tombol Lihat Semua -->
        <div class="mt-8 text-center">
            <a href="/galeri" class="bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700 inline-block">
                Lihat Semua
            </a>
        </div>
    </div>
</section>


    <!-- Fitur Layanan -->
    <section class="container mx-auto px-4 py-16 text-center">
        <h3 class="text-3xl font-semibold text-blue-600 mb-8">Fitur Layanan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <div class="flex justify-center mb-4">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/icons/truck.svg" class="w-12 h-12 text-blue-600" alt="Pengantaran Cepat">
                </div>
                <h4 class="font-semibold text-lg">Pengantaran Cepat</h4>
                <p class="text-gray-600 mt-2">Jaminan pengantaran cepat untuk setiap peminjaman alat.</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <div class="flex justify-center mb-4">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/icons/award.svg" class="w-12 h-12 text-blue-600" alt="Kualitas Terbaik">
                </div>
                <h4 class="font-semibold text-lg">Kualitas Terbaik</h4>
                <p class="text-gray-600 mt-2">Alat-alat terawat dengan baik untuk menjamin kualitas penggunaan.</p>
            </div>
            <div class="p-6 bg-white shadow-lg rounded-lg">
                <div class="flex justify-center mb-4">
                    <img src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/icons/hand-thumbs-up.svg" class="w-12 h-12 text-blue-600" alt="Proses Mudah">
                </div>
                <h4 class="font-semibold text-lg">Proses Mudah</h4>
                <p class="text-gray-600 mt-2">Proses peminjaman cepat dan mudah untuk setiap pelanggan.</p>
            </div>
        </div>
    </section>
    
    <!-- Testimoni Pelanggan (Infinite Running Card) -->
    <section class="bg-gray-100 py-16 overflow-hidden">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-semibold text-blue-600 mb-8">Testimoni Pelanggan</h3>
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
                            <h5 class="mt-4 font-semibold">Siti M.</h5>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Pilihan alatnya lengkap dan berkualitas."</p>
                            <h5 class="mt-4 font-semibold">Arman F.</h5>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Harga sewa yang terjangkau untuk kualitas yang sangat baik."</p>
                            <h5 class="mt-4 font-semibold">Lisa G.</h5>
                        </div>
                    </div>
                    <!-- Duplicate content for seamless scrolling -->
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
                            <h5 class="mt-4 font-semibold">Siti M.</h5>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Pilihan alatnya lengkap dan berkualitas."</p>
                            <h5 class="mt-4 font-semibold">Arman F.</h5>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg w-64 flex-shrink-0">
                            <p class="text-gray-600">"Harga sewa yang terjangkau untuk kualitas yang sangat baik."</p>
                            <h5 class="mt-4 font-semibold">Lisa G.</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('.animate-testimonial-scroll');
            container.style.animation = `testimonial-scroll ${container.childElementCount * 5}s linear infinite`;
        });
    </script>
    
        <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6282188865677" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white rounded-full p-4 shadow-lg hover:bg-green-600 transition duration-300 ease-in-out" aria-label="Chat WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="w-6 h-6">
            <path d="M13.601 2.599A7.875 7.875 0 0 0 8 0a7.952 7.952 0 0 0-4.227 1.224l-.603.379A7.95 7.95 0 0 0 0 8c0 1.425.373 2.792 1.087 4.004L0 16l3.902-.964A7.95 7.95 0 0 0 8 16a7.876 7.876 0 0 0 5.601-2.399A7.952 7.952 0 0 0 16 8a7.95 7.95 0 0 0-2.399-5.401zM8 14.531a6.496 6.496 0 0 1-3.611-1.08l-.26-.164-2.303.566.61-2.205-.17-.266A6.474 6.474 0 0 1 1.469 8c0-3.584 2.916-6.5 6.5-6.5a6.477 6.477 0 0 1 4.601 1.899A6.477 6.477 0 0 1 14.531 8c0 3.584-2.916 6.5-6.5 6.5z"/>
            <path d="M11.634 10.268c-.177-.088-1.046-.515-1.208-.574-.161-.059-.279-.088-.396.088-.117.176-.456.574-.559.692-.104.117-.208.132-.385.044-.177-.088-.747-.275-1.422-.878-.525-.467-.878-1.043-.981-1.22-.104-.176-.011-.271.078-.359.08-.079.177-.208.266-.311.09-.104.118-.176.18-.293.06-.117.03-.219-.015-.307-.044-.088-.396-.955-.543-1.311-.142-.342-.285-.296-.396-.296h-.34c-.118 0-.307.044-.468.219-.161.176-.61.598-.61 1.457 0 .859.625 1.683.713 1.799.088.117 1.226 1.907 2.966 2.672.415.18.739.287.99.367.416.132.794.113 1.093.068.333-.05 1.046-.427 1.194-.84.147-.412.147-.764.103-.84-.044-.073-.161-.117-.338-.205z"/>
        </svg>
    </a>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-200 py-8">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p>&copy; 2023 Ngesti Gongso Kemojing</p>
            <nav class="space-x-6">
                <a href="#" class="hover:text-white">Home</a>
                <a href="#" class="hover:text-white">Galeri</a>
                <a href="#" class="hover:text-white">Kontak</a>
            </nav>
        </div>
    </footer>
    
    

</body>
</html>
