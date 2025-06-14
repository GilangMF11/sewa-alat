<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <span class="brand-text font-weight-light">Hallo, <?= session()->get('name') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Menu Khusus Admin -->
                <?php if (session()->get('role') === 'admin'): ?>
                    <!-- Manajemen Produk -->
                    <li class="nav-item">
                        <a href="<?= base_url('product') ?>" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Manajemen Produk</p>
                        </a>
                    </li>

                    <!-- Kategori -->
                    <li class="nav-item">
                        <a href="<?= base_url('category') ?>" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Kategori</p>
                        </a>
                    </li>

                    <!-- Manajemen Transaksi -->
                    <li class="nav-item">
                        <a href="<?= base_url('order') ?>" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Manajemen Transaksi</p>
                        </a>
                    </li>

                    <!-- Status Sewa -->
                    <li class="nav-item">
                        <a href="<?= base_url('rental-status') ?>" class="nav-link">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Status Sewa</p>
                        </a>
                    </li>

                    <!-- Pengguna -->
                    <li class="nav-item">
                        <a href="<?= base_url('user') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>

                    <!-- Laporan -->
                    <li class="nav-item">
                        <a href="<?= base_url('report') ?>" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Laporan</p>
                        </a>
                    </li>

                    <!-- Pengaturan -->
                    <li class="nav-item">
                        <a href="<?= base_url('setting') ?>" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Pengaturan</p>
                        </a>
                    </li>

                    <!-- Backup -->
                    <li class="nav-item">
                        <a href="<?= base_url('backup') ?>" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>Backup & Restore</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Menu Khusus User -->
                <?php if (session()->get('role') === 'user'): ?>
                    <!-- Produk -->
                    <li class="nav-item">
                        <a href="<?= base_url('user/products-list') ?>" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Produk</p>
                        </a>
                    </li>

                    <!-- Cart -->
                    <li class="nav-item">
                        <a href="<?= base_url('user/cart') ?>" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Keranjang</p>
                        </a>
                    </li>

                    <!-- Riwayat Transaksi -->
                    <li class="nav-item">
                        <a href="<?= base_url('user/transactions') ?>" class="nav-link">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Transaksi</p>
                        </a>
                    </li>

                    <!-- Profil Saya -->
                    <li class="nav-item">
                        <a href="<?= base_url('profile') ?>" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil Saya</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="<?= base_url('logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
