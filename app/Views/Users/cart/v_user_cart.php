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
}
.cart-actions {
    display: flex;
    gap: 10px;
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
                <div class="alert alert-warning">Keranjang kamu kosong.</div>
            <?php else: ?>
                <div class="card">
                    <div class="card-body">
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
                                    <?php $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>
                                    <tr>
                                        <td>
                                            <img src="<?= base_url('show/product/' . $item['image']) ?>" alt="<?= esc($item['name']) ?>">
                                        </td>
                                        <td><?= esc($item['name']) ?></td>
                                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                        <td><?= esc($item['qty']) ?></td>
                                        <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                        <td class="cart-actions">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </button>
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

                        <div class="text-right mt-3">
                            <a href="#" class="btn btn-success">
                                <i class="fas fa-shopping-cart"></i> Checkout
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
