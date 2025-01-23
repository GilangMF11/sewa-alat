<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= isset($user['id']) ? 'Edit' : 'Tambah' ?> Pengguna</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Pengguna</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Form Input / Edit User -->
                <div class="card border-primary mb-4">
                    <div class="card-header custom-header-bg">
                        <h3 class="card-title font-weight-bold"><?= isset($user['id']) ? 'Edit' : 'Tambah' ?> Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <!-- Menampilkan error atau success message -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (isset($errors)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post" action="<?= base_url('/user/store') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= isset($user['id']) ? $user['id'] : '' ?>"> <!-- Hidden field for user ID (for update) -->
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?= isset($user['name']) ? esc($user['name']) : old('name') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= isset($user['email']) ? esc($user['email']) : old('email') ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?= isset($user['phone']) ? esc($user['phone']) : old('phone') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?= isset($user['address']) ? esc($user['address']) : old('address') ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="admin" <?= isset($user['role']) && $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                            <option value="user" <?= isset($user['role']) && $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirm">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><?= isset($user['id']) ? 'Update' : 'Simpan' ?> Pengguna</button>
                        </form>
                    </div>
                </div>

                <!-- Daftar Pengguna -->
                <div class="card border-primary">
                    <div class="card-header custom-header-bg">
                        <h3 class="card-title font-weight-bold">Daftar Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($user['name']) ?></td>
                                        <td><?= esc($user['email']) ?></td>
                                        <td><?= esc($user['phone']) ?></td>
                                        <td><?= esc($user['address']) ?></td>
                                        <td><?= esc($user['role']) ?></td>
                                        <td>
                                            <!-- Tombol Edit dan Hapus menggunakan ikon -->
                                            <a href="<?= base_url('/user/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('/user/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm delete-btn" data-id="<?= $user['id'] ?>"><i class="fas fa-trash"></i></a>
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

    <!-- Modal Edit Pengguna -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('user/store') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel">Edit Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Pengguna">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email Pengguna">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Masukkan Telepon Pengguna">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Masukkan Alamat Pengguna">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Pengguna</button>
                </div>
            </div>
        </form>
    </div>
</div>


    <!-- Script SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function () {
        // Konfirmasi hapus dengan SweetAlert
        $(".delete-btn").click(function (e) {
            e.preventDefault();
            var deleteUrl = "<?= base_url('user/delete/') ?>" + $(this).data('id');
            
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Pengguna ini akan dihapus!",
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

        // Isi modal edit dengan data pengguna
        $('#modalUpdate').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var email = button.data('email');
            var phone = button.data('phone');
            var address = button.data('address');
            var role = button.data('role');
            
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #role').val(role);
        });
    });
</script>


<?= $this->endSection() ?>
