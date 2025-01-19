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
                        <table class="table table-bordered">
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
                                            <a href="<?= base_url('/user/edit/' . $user['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?= base_url('/user/delete/' . $user['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</a>
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
<?= $this->endSection() ?>
