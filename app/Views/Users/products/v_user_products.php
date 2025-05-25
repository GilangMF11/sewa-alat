<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Enhanced Header Section -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="m-0 display-4 font-weight-bold text-primary">
                        <i class="fas fa-drum mr-3"></i>Katalog Alat Musik
                    </h1>
                    <p class="text-muted">Temukan dan sewa alat musik tradisional terbaik</p>
                </div>
                <div class="col-md-6">
                    <div class="search-section">
                        <form class="form-inline justify-content-end" method="get" action="<?= base_url('user/products-list') ?>">
                            <div class="input-group search-bar">
                                <input type="text" name="search" class="form-control form-control-lg" 
                                       placeholder="Cari alat musik..." value="<?= esc($_GET['search'] ?? '') ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-lg" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Statistics Section -->
    <div class="content-section">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="product-stats">
                                        <span class="badge badge-primary badge-lg mr-2">
                                            <i class="fas fa-boxes"></i> <?= count($products) ?> Produk
                                        </span>
                                        <span class="badge badge-success badge-lg mr-2">
                                            <i class="fas fa-check-circle"></i> 
                                            <?= count(array_filter($products, fn($p) => $p['stock'] > 0)) ?> Tersedia
                                        </span>
                                        <span class="badge badge-warning badge-lg">
                                            <i class="fas fa-exclamation-triangle"></i> 
                                            <?= count(array_filter($products, fn($p) => $p['stock'] <= 5 && $p['stock'] > 0)) ?> Stok Terbatas
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="filter-options text-right">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" id="sortPrice">
                                                <i class="fas fa-sort-amount-down"></i> Harga
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" id="sortStock">
                                                <i class="fas fa-sort-numeric-down"></i> Stok
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" id="filterAvailable">
                                                <i class="fas fa-filter"></i> Tersedia
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <section class="content">
        <div class="container-fluid">
            <?php if (empty($products)): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="empty-state">
                            <div class="card shadow-sm text-center py-5">
                                <div class="card-body">
                                    <i class="fas fa-search fa-5x text-muted mb-4"></i>
                                    <h4 class="text-muted">Produk Tidak Ditemukan</h4>
                                    <p class="text-muted mb-4">Maaf, tidak ada produk yang sesuai dengan pencarian Anda.</p>
                                    <a href="<?= base_url('user/products-list') ?>" class="btn btn-primary">
                                        <i class="fas fa-redo"></i> Lihat Semua Produk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row" id="productsContainer">
                    <?php foreach ($products as $item): ?>
                        <div class="col-lg-4 col-md-6 mb-4 product-item" 
                             data-price="<?= $item['price'] ?>" 
                             data-stock="<?= $item['stock'] ?>"
                             data-available="<?= $item['stock'] > 0 ? 'true' : 'false' ?>">
                            <div class="card product-card h-100 shadow-sm">
                                <!-- Product Image -->
                                <div class="image-container position-relative">
                                    <img src="<?= base_url('show/product/' . $item['image']) ?>" 
                                         class="card-img-top product-image" 
                                         alt="<?= esc($item['name']) ?>">
                                    
                                    <!-- Stock Badge -->
                                    <?php if ($item['stock'] <= 0): ?>
                                        <span class="badge badge-danger stock-badge">Habis</span>
                                    <?php elseif ($item['stock'] <= 5): ?>
                                        <span class="badge badge-warning stock-badge">Terbatas</span>
                                    <?php else: ?>
                                        <span class="badge badge-success stock-badge">Tersedia</span>
                                    <?php endif; ?>

                                    <!-- Hover Overlay -->
                                    <div class="image-overlay">
                                        <div class="overlay-content">
                                            <button class="btn btn-light btn-lg rounded-circle mb-3" 
                                                    <?= $item['stock'] <= 0 ? 'disabled' : '' ?>
                                                    data-toggle="modal" data-target="#cartModal<?= $item['id'] ?>">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                            <p class="text-white font-weight-bold">Tambah ke Keranjang</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="card-body d-flex flex-column">
                                    <div class="product-header mb-3">
                                        <h5 class="product-title mb-2"><?= esc($item['name']) ?></h5>
                                        <span class="category-badge"><?= esc($item['category_name']) ?? 'Tanpa Kategori' ?></span>
                                    </div>
                                    
                                    <p class="product-description text-muted"><?= esc(substr($item['description'], 0, 80)) ?><?= strlen($item['description']) > 80 ? '...' : '' ?></p>
                                    
                                    <div class="product-meta mb-3">
                                        <div class="stock-info">
                                            <i class="fas fa-boxes text-primary"></i>
                                            <span class="stock-text <?= $item['stock'] <= 5 ? 'stock-warning' : '' ?>">
                                                Stok: <?= $item['stock'] ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="price-section mt-auto">
                                        <div class="price-display">
                                            <span class="price-amount">Rp <?= number_format($item['price'], 0, ',', '.') ?></span>
                                            <span class="price-unit">/hari</span>
                                        </div>
                                        <small class="shipping-note">* Belum termasuk ongkir</small>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="card-footer bg-transparent">
                                    <div class="action-buttons">
                                        <button class="btn btn-outline-primary btn-block mb-2" 
                                                <?= $item['stock'] <= 0 ? 'disabled' : '' ?>
                                                data-toggle="modal" data-target="#cartModal<?= $item['id'] ?>">
                                            <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
                                        </button>
                                        <button class="btn btn-success btn-block" 
                                                <?= $item['stock'] <= 0 ? 'disabled' : '' ?>
                                                data-toggle="modal" data-target="#buyNowModal<?= $item['id'] ?>">
                                            <i class="fas fa-bolt mr-2"></i>Sewa Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL KERANJANG -->
                        <div class="modal fade" id="cartModal<?= $item['id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-gradient-primary text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="<?= base_url('user/cart/store') ?>">
                                        <?= csrf_field() ?>
                                        <div class="modal-body">
                                            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                            
                                            <div class="product-summary mb-4">
                                                <div class="row align-items-center">
                                                    <div class="col-4">
                                                        <img src="<?= base_url('show/product/' . $item['image']) ?>" 
                                                             class="img-fluid rounded">
                                                    </div>
                                                    <div class="col-8">
                                                        <h6 class="mb-1"><?= esc($item['name']) ?></h6>
                                                        <p class="text-muted mb-1">Rp <?= number_format($item['price'], 0, ',', '.') ?>/hari</p>
                                                        <small class="text-success">Stok tersedia: <?= $item['stock'] ?></small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Jumlah</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty('<?= $item['id'] ?>')">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="number" name="quantity" id="qty<?= $item['id'] ?>" 
                                                           value="1" min="1" max="<?= $item['stock'] ?>" 
                                                           class="form-control text-center" required>
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary" onclick="increaseQty('<?= $item['id'] ?>', <?= $item['stock'] ?>)">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Maksimal <?= $item['stock'] ?> item</small>
                                            </div>

                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                <strong>Catatan:</strong> Item akan ditambahkan ke keranjang. Anda dapat mengatur tanggal sewa di halaman checkout.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times mr-2"></i>Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL SEWA SEKARANG -->
                        <div class="modal fade" id="buyNowModal<?= $item['id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-gradient-success text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-bolt mr-2"></i>Sewa Sekarang
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <div class="product-preview mb-4">
                                            <img src="<?= base_url('show/product/' . $item['image']) ?>" 
                                                 class="rounded mb-3" style="max-height: 120px;">
                                            <h5 class="text-primary"><?= esc($item['name']) ?></h5>
                                            <h6 class="text-success">Rp <?= number_format($item['price'], 0, ',', '.') ?>/hari</h6>
                                        </div>
                                        
                                        <div class="alert alert-warning">
                                            <i class="fas fa-lightning-bolt mr-2"></i>
                                            <strong>Sewa Cepat:</strong> Item akan langsung ditambahkan ke keranjang dan mengarahkan Anda ke halaman checkout.
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            <i class="fas fa-times mr-2"></i>Batal
                                        </button>
                                        <form method="post" action="<?= base_url('user/cart/store') ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="direct_checkout" value="1">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-bolt mr-2"></i>Lanjut ke Checkout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<style>
/* Header Enhancements */
.display-4 {
    font-size: 2.5rem;
}

.search-bar {
    min-width: 350px;
}

.search-bar .form-control {
    border-radius: 25px 0 0 25px;
    border-right: none;
}

.search-bar .btn {
    border-radius: 0 25px 25px 0;
}

/* Product Cards */
.product-card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

/* Image Container */
.image-container {
    overflow: hidden;
    height: 250px;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.1);
}

/* Stock Badge */
.stock-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 0.8rem;
    padding: 6px 12px;
    border-radius: 20px;
    z-index: 2;
}

/* Image Overlay */
.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .image-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.product-card:hover .overlay-content {
    transform: translateY(0);
}

/* Product Info */
.product-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2c3e50;
    line-height: 1.3;
}

.category-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.product-description {
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Product Meta */
.product-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.stock-info {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stock-text {
    font-weight: 600;
    color: #28a745;
}

.stock-warning {
    color: #ffc107 !important;
    animation: pulse-warning 2s infinite;
}

@keyframes pulse-warning {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.6; }
}

/* Price Section */
.price-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 15px;
    border-radius: 10px;
    margin: 0 -15px -15px -15px;
}

.price-display {
    display: flex;
    align-items: baseline;
    gap: 5px;
    margin-bottom: 5px;
}

.price-amount {
    font-size: 1.4rem;
    font-weight: 700;
    color: #28a745;
}

.price-unit {
    color: #6c757d;
    font-size: 0.9rem;
}

.shipping-note {
    color: #dc3545;
    font-weight: 500;
}

/* Action Buttons */
.action-buttons .btn {
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Statistics Badges */
.badge-lg {
    font-size: 0.9rem;
    padding: 8px 15px;
    border-radius: 20px;
}

/* Modal Enhancements */
.modal-header.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.modal-header.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
}

.product-summary img {
    border-radius: 8px;
}

.input-group .btn {
    border-radius: 0;
}

.input-group .form-control {
    border-left: none;
    border-right: none;
}

/* Filter Options */
.filter-options .btn-group .btn {
    border-radius: 20px;
    margin-left: 5px;
}

.filter-options .btn.active {
    background: #007bff;
    color: white;
}

/* Empty State */
.empty-state .card {
    border: 2px dashed #dee2e6;
    background: #fafafa;
}

/* Responsive */
@media (max-width: 768px) {
    .display-4 {
        font-size: 1.8rem;
    }
    
    .search-bar {
        min-width: 100%;
        margin-top: 15px;
    }
    
    .filter-options {
        text-align: left !important;
        margin-top: 15px;
    }
    
    .product-stats {
        margin-bottom: 15px;
    }
    
    .badge-lg {
        font-size: 0.8rem;
        padding: 6px 12px;
        margin-bottom: 5px;
        display: inline-block;
    }
}

/* Loading Animation */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: "";
    width: 16px;
    height: 16px;
    margin-left: 10px;
    border: 2px solid transparent;
    border-top: 2px solid #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: inline-block;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity control functions
    window.increaseQty = function(itemId, maxStock) {
        const qtyInput = document.getElementById('qty' + itemId);
        const currentQty = parseInt(qtyInput.value);
        if (currentQty < maxStock) {
            qtyInput.value = currentQty + 1;
        }
    };
    
    window.decreaseQty = function(itemId) {
        const qtyInput = document.getElementById('qty' + itemId);
        const currentQty = parseInt(qtyInput.value);
        if (currentQty > 1) {
            qtyInput.value = currentQty - 1;
        }
    };
    
    // Filter and Sort functionality
    const sortPriceBtn = document.getElementById('sortPrice');
    const sortStockBtn = document.getElementById('sortStock');
    const filterAvailableBtn = document.getElementById('filterAvailable');
    const productsContainer = document.getElementById('productsContainer');
    
    let currentSort = '';
    let showOnlyAvailable = false;
    
    if (sortPriceBtn) {
        sortPriceBtn.addEventListener('click', function() {
            currentSort = currentSort === 'price-asc' ? 'price-desc' : 'price-asc';
            this.classList.toggle('active');
            sortStockBtn.classList.remove('active');
            sortProducts();
        });
    }
    
    if (sortStockBtn) {
        sortStockBtn.addEventListener('click', function() {
            currentSort = currentSort === 'stock-asc' ? 'stock-desc' : 'stock-asc';
            this.classList.toggle('active');
            sortPriceBtn.classList.remove('active');
            sortProducts();
        });
    }
    
    if (filterAvailableBtn) {
        filterAvailableBtn.addEventListener('click', function() {
            showOnlyAvailable = !showOnlyAvailable;
            this.classList.toggle('active');
            filterProducts();
        });
    }
    
    function sortProducts() {
        const products = Array.from(document.querySelectorAll('.product-item'));
        
        products.sort((a, b) => {
            let aValue, bValue;
            
            if (currentSort.includes('price')) {
                aValue = parseInt(a.dataset.price);
                bValue = parseInt(b.dataset.price);
            } else if (currentSort.includes('stock')) {
                aValue = parseInt(a.dataset.stock);
                bValue = parseInt(b.dataset.stock);
            }
            
            if (currentSort.includes('desc')) {
                return bValue - aValue;
            } else {
                return aValue - bValue;
            }
        });
        
        // Clear container and append sorted products
        productsContainer.innerHTML = '';
        products.forEach(product => productsContainer.appendChild(product));
    }
    
    function filterProducts() {
        const products = document.querySelectorAll('.product-item');
        
        products.forEach(product => {
            if (showOnlyAvailable) {
                if (product.dataset.available === 'true') {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            } else {
                product.style.display = 'block';
            }
        });
    }
    
    // Form submission loading state
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            }
        });
    });
    
    // Auto-focus search input on page load
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput && !searchInput.value) {
        // Don't auto-focus if there's already a search term
        // searchInput.focus();
    }
});
</script>

<?= $this->endSection() ?>