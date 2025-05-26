<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<style>
    .content-wrapper {
        background: linear-gradient(135deg, #f8f9fc 0%, #e9ecef 100%);
        min-height: calc(100vh - 60px);
    }
    
    .content-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 0 0 20px 20px;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .page-header {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .page-title {
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
    }
    
    .continue-shopping-btn {
        background: linear-gradient(45deg, #36d1dc, #5b86e5);
        border: none;
        border-radius: 25px;
        padding: 8px 20px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(54, 209, 220, 0.3);
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .continue-shopping-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(54, 209, 220, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .empty-cart {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 3rem 2rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }
    
    .empty-cart-icon {
        font-size: 4rem;
        color: #ffd93d;
        margin-bottom: 1rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    .cart-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .cart-header {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 1.5rem 2rem;
        border: none;
    }
    
    .cart-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.3rem;
    }
    
    .cart-table-container {
        padding: 1.5rem;
    }
    
    .cart-table {
        font-size: 0.95rem;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        border: none;
    }
    
    .cart-table thead th {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border: none;
        color: #495057;
        font-weight: 600;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .cart-table tbody tr {
        border: none;
        transition: all 0.3s ease;
    }
    
    .cart-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .cart-table tbody td {
        border: none;
        padding: 1.2rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }
    
    .product-image:hover {
        transform: scale(1.1);
    }
    
    .product-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1rem;
    }
    
    .price-text {
        font-weight: 600;
        color: #27ae60;
        font-size: 1.1rem;
    }
    
    .quantity-badge {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-block;
        min-width: 50px;
        text-align: center;
    }
    
    .subtotal-text {
        font-weight: 700;
        color: #e74c3c;
        font-size: 1.1rem;
    }
    
    .action-btn {
        border-radius: 50px;
        padding: 10px;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 2px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .delete-btn {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        color: white;
    }
    
    .delete-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        color: white;
    }
    
    .edit-btn {
        background: linear-gradient(45deg, #4ecdc4, #44a08d);
        color: white;
    }
    
    .edit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 205, 196, 0.4);
        color: white;
    }
    
    .cart-footer {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        padding: 1.5rem 2rem;
        border-top: 3px solid #667eea;
    }
    
    .total-row {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
    }
    
    .total-row th {
        padding: 1.5rem 1rem;
        font-size: 1.2rem;
        font-weight: 700;
        border: none;
    }
    
    .checkout-section {
        text-align: center;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0 0 20px 20px;
    }
    
    .checkout-btn {
        background: linear-gradient(45deg, #00b894, #00a085);
        border: none;
        border-radius: 50px;
        padding: 15px 40px;
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0, 184, 148, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .checkout-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 184, 148, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .modal-content {
        border-radius: 20px;
        border: none;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    
    .modal-header {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        padding: 1.5rem 2rem;
    }
    
    .modal-title {
        font-weight: 600;
        margin: 0;
    }
    
    .modal-body {
        padding: 2rem;
    }
    
    .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .modal-footer {
        padding: 1.5rem 2rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .btn-modal {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-modal:hover {
        transform: translateY(-1px);
    }
    
    @media (max-width: 992px) {
        .content-header .d-flex {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
        
        .page-title {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .cart-table-container {
            padding: 1rem;
        }
        
        .cart-table {
            font-size: 0.85rem;
        }
        
        .cart-table thead th {
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .cart-table tbody td {
            padding: 1rem 0.5rem;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
        }
        
        .product-name {
            font-size: 0.9rem;
        }
        
        .price-text, .subtotal-text {
            font-size: 0.9rem;
        }
        
        .quantity-badge {
            padding: 6px 12px;
            font-size: 0.85rem;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            font-size: 0.8rem;
        }
        
        .checkout-btn {
            padding: 12px 25px;
            font-size: 1rem;
        }
        
        .cart-footer {
            padding: 1rem 1.5rem;
        }
        
        .cart-footer .row {
            text-align: center;
        }
        
        .cart-footer .col-md-6:first-child {
            margin-bottom: 0.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.6rem;
        }
        
        .cart-table-container {
            padding: 0.75rem;
        }
        
        .cart-table {
            font-size: 0.8rem;
        }
        
        .cart-table thead th {
            padding: 0.5rem 0.25rem;
            font-size: 0.7rem;
        }
        
        .cart-table tbody td {
            padding: 0.75rem 0.25rem;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
        }
        
        .product-name {
            font-size: 0.8rem;
        }
        
        .price-text, .subtotal-text {
            font-size: 0.8rem;
        }
        
        .quantity-badge {
            padding: 4px 8px;
            font-size: 0.75rem;
            min-width: 40px;
        }
        
        .action-btn {
            width: 30px;
            height: 30px;
            font-size: 0.75rem;
            margin: 0 1px;
        }
        
        .checkout-btn {
            padding: 10px 20px;
            font-size: 0.9rem;
        }
        
        /* Hide some columns on mobile for better readability */
        .cart-table .mobile-hide {
            display: none;
        }
        
        .cart-footer h4 {
            font-size: 1rem;
        }
        
        .cart-footer h3 {
            font-size: 1.2rem;
        }
    }
    
    @media (max-width: 576px) {
        .content-header {
            margin-bottom: 1rem;
            border-radius: 0;
        }
        
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.4rem;
        }
        
        .continue-shopping-btn {
            padding: 6px 15px;
            font-size: 0.8rem;
        }
        
        .empty-cart {
            padding: 2rem 1rem;
            margin: 1rem 0;
            border-radius: 10px;
        }
        
        .empty-cart-icon {
            font-size: 3rem;
        }
        
        .cart-card {
            border-radius: 10px;
            margin: 0 -15px;
        }
        
        .cart-table-container {
            padding: 0.5rem;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .checkout-section {
            padding: 1.5rem 1rem;
        }
    }
    
    /* Floating elements animation */
    .floating {
        animation: floating 3s ease-in-out infinite;
    }
    
    @keyframes floating {
        0% { transform: translate(0, 0px); }
        50% { transform: translate(0, -10px); }
        100% { transform: translate(0, 0px); }
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h1 class="page-title">🛒 Keranjang Belanja</h1>
                    <a href="<?= base_url('user/products-list') ?>" class="continue-shopping-btn">
                        <i class="fas fa-arrow-left me-2"></i> Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (empty($cartItems)): ?>
                <div class="empty-cart floating">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3 class="mb-3" style="color: #495057;">Keranjang Kamu Kosong</h3>
                    <p class="text-muted mb-4">Yuk, mulai belanja dan temukan produk terbaik untuk kamu!</p>
                    <a href="<?= base_url('user/products-list') ?>" class="continue-shopping-btn">
                        <i class="fas fa-shopping-bag me-2"></i> Mulai Belanja
                    </a>
                </div>
            <?php else: ?>
                <div class="cart-card">
                    <div class="cart-header">
                        <h3><i class="fas fa-list-ul me-2"></i> Detail Keranjang</h3>
                    </div>
                    
                    <div class="cart-table-container">
                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Produk</th>
                                        <th>Nama</th>
                                        <th class="mobile-hide">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th>Subtotal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; foreach ($cartItems as $item): ?>
                                        <?php 
                                            $subtotal = $item['price'] * $item['quantity']; 
                                            $total += $subtotal; 
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <img src="<?= base_url('show/product/' . $item['image']) ?>" 
                                                     alt="<?= esc($item['name']) ?>" 
                                                     class="product-image">
                                            </td>
                                            <td>
                                                <div class="product-name"><?= esc($item['name']) ?></div>
                                                <div class="d-md-none">
                                                    <small class="price-text">Rp <?= number_format($item['price'], 0, ',', '.') ?></small>
                                                </div>
                                            </td>
                                            <td class="mobile-hide">
                                                <span class="price-text">Rp <?= number_format($item['price'], 0, ',', '.') ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="quantity-badge"><?= esc($item['quantity']) ?></span>
                                            </td>
                                            <td>
                                                <span class="subtotal-text">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="<?= base_url('user/cart/delete/' . $item['id']) ?>" 
                                                       class="action-btn delete-btn" 
                                                       title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <!-- <a href="#" 
                                                       class="action-btn edit-btn" 
                                                       data-id="<?= $item['id'] ?>" 
                                                       data-quantity="<?= $item['quantity'] ?>" 
                                                       data-toggle="modal" 
                                                       data-target="#editQuantityModal"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a> -->
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="cart-footer">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-0" style="color: #495057;">
                                    <i class="fas fa-calculator me-2"></i>
                                    Total Pembayaran
                                </h4>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h3 class="mb-0" style="color: #e74c3c; font-weight: 700;">
                                    Rp <?= number_format($total, 0, ',', '.') ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-section">
                        <a href="<?= base_url('user/checkout') ?>" class="checkout-btn floating">
                            <i class="fas fa-credit-card me-2"></i> Checkout Sekarang
                        </a>
                        <p class="mt-3 mb-0 text-muted">
                            <i class="fas fa-shield-alt me-1"></i>
                            Pembayaran aman dan terpercaya
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<!-- Modal Edit Quantity -->
<div class="modal fade" id="editQuantityModal" tabindex="-1" role="dialog" aria-labelledby="editQuantityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuantityModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Jumlah Barang
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/cart/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="cart_item_id" id="cart_item_id">
                    <div class="form-group">
                        <label class="form-label fw-bold">Jumlah Barang</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                        <small class="form-text text-muted">Minimal 1 barang</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal" data-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary btn-modal">
                        <i class="fas fa-save me-1"></i>Update Jumlah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert2 Konfirmasi Delete dengan styling custom
        $(".delete-btn").click(function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');

            Swal.fire({
                title: '🗑️ Hapus Item?',
                text: "Item ini akan dihapus dari keranjang belanja kamu!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-1"></i>Ya, Hapus!',
                cancelButtonText: '<i class="fas fa-times me-1"></i>Batal',
                customClass: {
                    popup: 'swal-custom-popup',
                    title: 'swal-custom-title',
                    confirmButton: 'swal-custom-confirm',
                    cancelButton: 'swal-custom-cancel'
                },
                background: 'rgba(255, 255, 255, 0.95)',
                backdrop: 'rgba(102, 126, 234, 0.4)'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Loading animation
                    Swal.fire({
                        title: 'Menghapus...',
                        html: 'Tunggu sebentar ya!',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Redirect after short delay for better UX
                    setTimeout(() => {
                        window.location.href = deleteUrl;
                    }, 1000);
                }
            });
        });

        // Modal Edit Quantity dengan animasi
        $('.edit-btn').click(function() {
            var itemId = $(this).data('id');
            var quantity = $(this).data('quantity');

            $('#cart_item_id').val(itemId);
            $('#quantity').val(quantity);
            
            // Focus pada input dengan delay
            setTimeout(() => {
                $('#quantity').focus().select();
            }, 500);
        });

        // Animasi hover untuk tombol
        $('.action-btn').hover(
            function() {
                $(this).addClass('animate__animated animate__pulse');
            },
            function() {
                $(this).removeClass('animate__animated animate__pulse');
            }
        );

        // Smooth scroll untuk checkout button
        $('.checkout-btn').click(function(e) {
            $(this).addClass('animate__animated animate__heartBeat');
            setTimeout(() => {
                $(this).removeClass('animate__animated animate__heartBeat');
            }, 1000);
        });
    });

    // Custom SweetAlert2 styles
    const style = document.createElement('style');
    style.textContent = `
        .swal-custom-popup {
            border-radius: 20px !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3) !important;
        }
        .swal-custom-title {
            color: #495057 !important;
            font-weight: 600 !important;
        }
        .swal-custom-confirm {
            border-radius: 25px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
        }
        .swal-custom-cancel {
            border-radius: 25px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
        }
    `;
    document.head.appendChild(style);
</script>

<?= $this->endSection() ?>