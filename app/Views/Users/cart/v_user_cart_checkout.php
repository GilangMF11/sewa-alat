<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<style>
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
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Checkout</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('user/checkout/store') ?>" method="post" id="checkoutForm">
                <?= csrf_field() ?>

                <div class="card">
                    <div class="card-body">
                        <h5>Data Penyewa</h5>
                        <div class="form-group">
                            <label>Nama Penyewa</label>
                            <input type="text" name="customer_name" class="form-control" required value="<?= session('name') ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat Penyewa</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
                        </div>

                        <hr>

                        <h5>Data Sewa</h5>
                        <div class="form-group">
                            <label>Tanggal Pinjam</label>
                            <input type="date" name="borrow_date" class="form-control" id="borrow_date" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kembali</label>
                            <input type="date" name="return_date" class="form-control" id="return_date" required>
                        </div>

                        <hr>

                        <h5>Ringkasan Produk</h5>
                        <ul class="list-group mb-3" id="summaryList">
                            <?php $total = 0; foreach ($cartItems as $item): ?>
                                <?php 
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center product-item"
                                    data-price="<?= $item['price'] ?>"
                                    data-qty="<?= $item['quantity'] ?>">
                                    <?= esc($item['name']) ?> (<?= esc($item['quantity']) ?>)
                                    <span class="item-total">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                                </li>
                            <?php endforeach; ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Total</strong>
                                <strong id="totalPriceDisplay">Rp <?= number_format($total, 0, ',', '.') ?></strong>
                            </li>
                        </ul>

                        <h5>Metode Pembayaran</h5>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1" name="payment_type" value="2" checked>
                                <label for="customRadio1" class="custom-control-label">Transfer</label>
                            </div>
                        </div>
                        <p class="blink-red">* Belum termasuk Ongkir</p>

                        <div class="text-right">
                            <a href="<?= base_url('user/cart') ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-shopping-cart"></i> Proses Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    function calculateDays() {
        const borrowDate = new Date(document.getElementById('borrow_date').value);
        const returnDate = new Date(document.getElementById('return_date').value);

        if (!isNaN(borrowDate) && !isNaN(returnDate) && returnDate >= borrowDate) {
            const oneDay = 24 * 60 * 60 * 1000;
            const duration = Math.max(1, Math.round((returnDate - borrowDate) / oneDay) + 1);

            let total = 0;
            document.querySelectorAll('.product-item').forEach(el => {
                const price = parseInt(el.dataset.price);
                const qty = parseInt(el.dataset.qty);
                const subtotal = price * qty * duration;
                total += subtotal;

                el.querySelector('.item-total').textContent = formatRupiah(subtotal);
            });

            document.getElementById('totalPriceDisplay').textContent = formatRupiah(total);
        }
    }

    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    document.getElementById('borrow_date').addEventListener('change', calculateDays);
    document.getElementById('return_date').addEventListener('change', calculateDays);
</script>

<?= $this->endSection() ?>
