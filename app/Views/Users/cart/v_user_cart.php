<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<style>
.cart-table {
    font-size: 0.9rem;
}
.cart-table img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.cart-actions {
    display: flex;
    gap: 5px;
}
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Keranjang Belanja</h1>
            <a href="<?= base_url('user/products-list') ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Lanjut Belanja
            </a>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (empty($cartItems)): ?>
                <div class="alert alert-warning text-center">
                    <i class="fas fa-shopping-cart fa-2x mb-2"></i><br>
                    Keranjang kamu kosong.
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-header bg-light">
                        <h3 class="card-title">Detail Keranjang</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover cart-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Produk</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
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
                                                <img src="<?= base_url('show/product/' . $item['image']) ?>" alt="<?= esc($item['name']) ?>">
                                            </td>
                                            <td><?= esc($item['name']) ?></td>
                                            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                            <td><?= esc($item['quantity']) ?></td>
                                            <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                            <td class="cart-actions text-center">
                                                <a href="<?= base_url('cart/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus item ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="<?= base_url('cart/edit/' . $item['id']) ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Total</th>
                                        <th colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="text-right mt-4">
                            <a href="<?= base_url('user/checkout') ?>" class="btn btn-success btn-lg">
                                <i class="fas fa-shopping-cart"></i> Checkout Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
