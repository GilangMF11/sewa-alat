<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Card with custom background color on the header -->
                <div class="card border-primary">
                    <div class="card-header custom-header-bg">
                        <h3 class="card-title font-weight-bold">Pengaturan Website</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <!-- Logo -->
                            <div class="form-group row">
                                <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="logo" name="logo">
                                    <small class="form-text text-muted">Upload logo website (JPG, PNG, max 2MB)</small>
                                </div>
                            </div>

                            <!-- Nama Website -->
                            <div class="form-group row">
                                <label for="websiteName" class="col-sm-2 col-form-label">Nama Website</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="websiteName" name="websiteName" value="Nama Website Anda">
                                </div>
                            </div>

                            <!-- Nama NO WA -->
                            <div class="form-group row">
                                <label for="websiteName" class="col-sm-2 col-form-label">No WA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="websiteName" name="websiteName" value="085123456789">
                                </div>
                            </div>

                            <!-- Background -->
                            <div class="form-group row">
                                <label for="logo" class="col-sm-2 col-form-label">Latar Belakang</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="logo" name="logo">
                                    <small class="form-text text-muted">Upload Background (JPG, PNG, max 2MB)</small>
                                </div>
                            </div>

                            <!-- URL Sosial Media -->
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="facebook" name="facebook" value="https://facebook.com/username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="instagram" name="instagram" value="https://instagram.com/username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="twitter" name="twitter" value="https://twitter.com/username">
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
        <!-- /.content -->
    </div>
<?= $this->endSection() ?>

<script>
    // Optional: Add script for form submission or validations if needed.
</script>

<style>
    /* Custom background color for the card header */
    .custom-header-bg {
        background-color: #4caf50; /* Ganti warna sesuai keinginan */
        color: white; /* Mengubah teks menjadi putih agar kontras */
    }
</style>
