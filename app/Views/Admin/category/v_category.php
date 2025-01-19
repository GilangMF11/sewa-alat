<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Tambah Kategori -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Kategori</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('category/store') ?>" method="post">
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Kategori">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Kategori</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($categories as $row) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['name']; ?></td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalUpdate" data-id="<?= $row['id']; ?>" data-name="<?= $row['name']; ?>"><i class="fas fa-edit"></i></button>
                                                    <!-- SweetAlert2 Delete Confirmation -->
                                                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id']; ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Update Category -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url('category/store') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUpdateLabel">Update Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Kategori">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Modal Update Category -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert2 Konfirmasi Delete
            $(".delete-btn").click(function(e) {
                e.preventDefault();
                var deleteUrl = "<?= base_url('category/delete/') ?>" + $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Kategori ini akan dihapus!",
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

            // Modal Update Category
            $('#modalUpdate').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
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
