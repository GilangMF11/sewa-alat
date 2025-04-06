<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pengaturan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card border-primary">
                <div class="card-header custom-header-bg">
                    <h3 class="card-title font-weight-bold">Pengaturan Website</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('setting/save') ?>" method="post" enctype="multipart/form-data">

                        <!-- Logo -->
                        <div class="form-group row">
                            <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                            <div class="col-sm-10">
                                <?php if (!empty($setting['logo'])): ?>
                                    <img src="<?= base_url('uploads/logo/' . $setting['logo']) ?>" alt="Logo" width="100" class="mb-2">
                                <?php endif; ?>
                                <input type="file" class="form-control" id="logo" name="logo">
                                <small class="form-text text-muted">Upload logo website (JPG, PNG, max 2MB)</small>
                            </div>
                        </div>

                        <!-- Nama Website -->
                        <div class="form-group row">
                            <label for="name_web" class="col-sm-2 col-form-label">Nama Website</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name_web" name="name_web" value="<?= old('name_web', $setting['name_web'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- No WhatsApp -->
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">No WA</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" value="<?= old('phone', $setting['phone'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Background -->
                        <div class="form-group row">
                            <label for="background" class="col-sm-2 col-form-label">Latar Belakang</label>
                            <div class="col-sm-10">
                                <?php if (!empty($setting['background'])): ?>
                                    <img src="<?= base_url('uploads/background/' . $setting['background']) ?>" alt="Background" width="100" class="mb-2">
                                <?php endif; ?>
                                <input type="file" class="form-control" id="background" name="background">
                                <small class="form-text text-muted">Upload Background (JPG, PNG, max 2MB)</small>
                            </div>
                        </div>

                        <!-- Sosial Media -->
                        <div class="form-group row">
                            <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" id="facebook" name="facebook" value="<?= old('facebook', $setting['facebook'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" id="instagram" name="instagram" value="<?= old('instagram', $setting['instagram'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                            <div class="col-sm-10">
                                <input type="url" class="form-control" id="twitter" name="twitter" value="<?= old('twitter', $setting['twitter'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
<!-- Panggil SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menampilkan SweetAlert2 setelah Insert/Update/Delete
    <?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session()->getFlashdata('success'); ?>',
    });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '<?= session()->getFlashdata('error'); ?>',
    });
    <?php endif; ?>
});
</script>
<style>
    .custom-header-bg {
        background-color: #4caf50;
        color: white;
    }
</style>
