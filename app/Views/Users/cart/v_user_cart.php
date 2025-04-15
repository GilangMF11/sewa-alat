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
                            <table id="example1" class="table table-bordered table-hover cart-table">
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
                                                <a href="<?= base_url('user/cart/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <!-- <a href="#" class="btn btn-info btn-sm edit-btn" data-id="<?= $item['id'] ?>" data-quantity="<?= $item['quantity'] ?>" data-toggle="modal" data-target="#editQuantityModal">
                                                    <i class="fas fa-edit"></i>
                                                </a> -->
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

<!-- Modal Edit Quantity -->
<div class="modal fade" id="editQuantityModal" tabindex="-1" role="dialog" aria-labelledby="editQuantityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editQuantityModalLabel">Edit Jumlah Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/cart/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="cart_item_id" id="cart_item_id">
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Jumlah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert2 Konfirmasi Delete
        $(".delete-btn").click(function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Item ini akan dihapus dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });

        // Modal Edit Quantity
        $('.edit-btn').click(function() {
            var itemId = $(this).data('id');
            var quantity = $(this).data('quantity');

            $('#cart_item_id').val(itemId);
            $('#quantity').val(quantity);
        });
    });
</script>

<?= $this->endSection() ?>
