<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<style>
    .card-img-overlay {
        background-color: rgba(0, 0, 0, 0.6);
        opacity: 0;
        transition: opacity 0.3s ease;
        color: white;
    }

    .card:hover .card-img-overlay {
        opacity: 1;
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .search-bar {
        margin-bottom: 20px;
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
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Daftar Produk</h1>
            <form class="form-inline" method="get" action="<?= base_url('user/products-list') ?>">
                <div class="input-group search-bar">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= esc($_GET['search'] ?? '') ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (empty($products)): ?>
                <div class="alert alert-warning">Produk tidak ditemukan.</div>
            <?php endif; ?>
            <div class="row">
                <?php foreach ($products as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm position-relative overflow-hidden">
                            <div class="position-relative cursor-pointer" data-toggle="modal" data-target="#productModal<?= $item['id'] ?>">
                                <img src="<?= base_url('show/product/' . $item['image']) ?>" class="card-img-top" alt="<?= esc($item['name']) ?>" style="height: 200px; object-fit: cover;">
                                <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                    <h5 class="text-center">Klik untuk detail</h5>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-1 text-bold"><?= esc($item['name']) ?></h5>
                                <p class="card-text"><?= esc($item['description']) ?></p>
                                <p class="text-muted mb-1"><small>Kategori: <?= esc($item['category_name']) ?? '-' ?></small></p>
                                <p class="blink-red"><small>Stok: <?= esc($item['stock']) ?? '-' ?></small></p>
                                <h6 class="text-primary mt-auto">Rp <?= number_format($item['price'], 0, ',', '.') ?></h6>
                                <p><small>* Belum termasuk Ongkir</small></p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <button class="btn btn-sm btn-outline-primary" <?= $item['stock'] <= 0 ? 'disabled' : '' ?> data-toggle="modal" data-target="#productModal<?= $item['id'] ?>">
                                    <i class="fas fa-shopping-cart"></i> Keranjang
                                </button>
                                <a href="https://wa.me/6282188865677?text=Halo,%20saya%20tertarik%20dengan%20produk%20<?= urlencode($item['name']) ?>"
                                   class="btn btn-sm btn-success <?= $item['stock'] <= 0 ? 'disabled' : '' ?>">
                                    <i class="fas fa-bolt"></i> Sewa Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL DETAIL -->
                    <div class="modal fade" id="productModal<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="productModalLabel<?= $item['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="productModalLabel<?= $item['id'] ?>"><?= esc($item['name']) ?></h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body d-flex flex-column flex-md-row">
                                    <img src="<?= base_url('show/product/' . $item['image']) ?>" class="img-fluid rounded w-50 mr-3" alt="<?= esc($item['name']) ?>">
                                    <div>
                                        <p><strong>Kategori:</strong> <?= esc($item['category_name']) ?? '-' ?></p>
                                        <p><strong>Harga:</strong> Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                                        <p><strong>Stok:</strong> <?= esc($item['stock']) ?></p>
                                        <p><strong>Deskripsi:</strong> <?= esc($item['description']) ?></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <a href="https://wa.me/6282188865677?text=Halo,%20saya%20tertarik%20dengan%20produk%20<?= urlencode($item['name']) ?>"
                                       class="btn btn-success <?= $item['stock'] <= 0 ? 'disabled' : '' ?>">
                                       <i class="fas fa-bolt"></i> Beli Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL -->
                <?php endforeach ?>
            </div>
        </div>
    </section>
</div>

<!-- Tambahkan Bootstrap JS jika belum -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection() ?>
