<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Tambah Produk -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Produk</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('product/store') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Nama Produk</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Produk" value="<?= old('name') ?>">
                                <?= isset($validation) ? $validation->getError('name') : '' ?>
                            </div>

                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" name="price" class="form-control" id="price" placeholder="Masukkan Harga Produk" value="<?= old('price') ?>">
                                <?= isset($validation) ? $validation->getError('price') : '' ?>
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="5" placeholder="Masukkan Deskripsi Produk"><?= old('description') ?></textarea>
                                <?= isset($validation) ? $validation->getError('description') : '' ?>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Kategori</label>
                                <select name="category_id" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= isset($validation) ? $validation->getError('category_id') : '' ?>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <input type="number" name="stock" class="form-control" id="stock" placeholder="Masukkan Stok Produk" value="<?= old('stock') ?>">
                                <?= isset($validation) ? $validation->getError('stock') : '' ?>
                            </div>

                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input type="file" name="image" class="form-control" id="image">
                                <?= isset($validation) ? $validation->getError('image') : '' ?>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Daftar Produk -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Produk</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $index => $product): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $product['name'] ?></td>
                                        <td><?= $product['category_name'] ?></td>
                                        <td><?= number_format($product['price'], 2) ?></td>
                                        <td><?= $product['stock'] ?></td>
                                        <td><a href="" 
                                        data-toggle="modal" 
                                        data-target="#modalImage" 
                                        data-image="<?= base_url('show/product/' . $product['image']) ?>" 
                                        data-description="<?= $product['description']; ?>"
                                        data-name="<?= $product['name']; ?>">Lihat</a></td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" 
                                            class="btn btn-sm btn-primary" 
                                            data-toggle="modal" 
                                            data-target="#modalUpdate" 
                                            data-id="<?= $product['id']; ?>" 
                                            data-name="<?= $product['name']; ?>"
                                            data-category-name="<?= $product['category_id']; ?>"
                                            data-price="<?= $product['price']; ?>"
                                            data-description="<?= $product['description']; ?>"
                                            data-stock="<?= $product['stock']; ?>"
                                            data-gambar="<?= $product['image']; ?>"><i class="fas fa-edit"></i>
                                             <!-- SweetAlert2 Delete Confirmation -->
                                             <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="<?= $product['id']; ?>"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Update Product -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('product/store') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel">Update Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Hidden ID Field -->
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Produk">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Masukkan Harga Produk">
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Masukkan Deskripsi Produk" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" name="stock" class="form-control" id="stock" placeholder="Masukkan Stok Produk">
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" class="form-control" id="image">
                        <br>
                        <!-- Menampilkan gambar lama jika ada -->
                    <img src="" id="modalImageSrc" alt="Gambar Produk" width="150">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

        <!-- Modal Lihat Gambar -->
        <div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="modalImageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImageLabel">Gambar <span name="name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <!-- Gambar akan ditampilkan di sini -->
                    <img src="" id="modalImageSrc" class="img-fluid" alt="Gambar Produk">
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control" id="description" placeholder="Masukkan Deskripsi Produk" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


     <!-- Script Modal Update Product -->
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menampilkan Gambar di Modal
            $('#modalImage').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Tautan yang diklik
                var imageSrc = button.data('image'); // Mendapatkan URL gambar
                var description = button.data('description');
                
                var modal = $(this);
                modal.find('.modal-body #modalImageSrc').attr('src', imageSrc); // Set gambar di modal
                modal.find('.modal-body #description').val(description);
            });

            // SweetAlert2 Konfirmasi Delete
            $(".delete-btn").click(function(e) {
                e.preventDefault();
                var deleteUrl = "<?= base_url('product/delete/') ?>" + $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Product ini akan dihapus!",
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

            // Modal Update Product
            $('#modalUpdate').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var categoryName = button.data('category-name'); // Tidak ada input bernama categoryName di modal
                var price = button.data('price');
                var description = button.data('description');
                var stock = button.data('stock');
                var image = button.data('image');
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #category_id').val(categoryName); // Perbaiki sesuai nama input di modal
                modal.find('.modal-body #price').val(price);
                modal.find('.modal-body #description').val(description);
                modal.find('.modal-body #stock').val(stock);
                modal.find('.modal-body #modalImageSrc').attr('src', '<?= base_url('show/product/') ?>' . image);
                
                // Jangan set nilai input file, biarkan kosong
            });


            // Menampilkan SweetAlert2 setelah Insert/Update/Delete
            <?php if (session()->getFlashdata('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= session()->getFlashdata('success'); ?>',
                });
            <?php endif; ?>
        });
    </script>
<?= $this->endSection() ?>
