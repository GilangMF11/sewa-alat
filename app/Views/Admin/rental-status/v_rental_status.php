<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Status Sewa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Status Sewa</li>
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
                    <h3 class="card-title font-weight-bold">Status Sewa Barang</h3>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <div class="row mb-3">
                        <form method="get" action="<?= base_url('rental-status') ?>" class="form-inline">
                            <select name="status" class="form-control">
                                <option value="">Status Sewa</option>
                                <option value="1" <?= ($_GET['status'] ?? '') == '1' ? 'selected' : '' ?>>Sudah
                                    Dikembalikan</option>
                                <option value="0" <?= ($_GET['status'] ?? '') == '0' ? 'selected' : '' ?>>Belum
                                    Dikembalikan</option>
                            </select>

                            <select name="bulan" class="form-control mx-2">
                                <option value="">Pilih Bulan</option>
                                <option value="01" <?= ($_GET['bulan'] ?? '') == '01' ? 'selected' : '' ?>>Januari
                                </option>
                                <option value="02" <?= ($_GET['bulan'] ?? '') == '02' ? 'selected' : '' ?>>Februari
                                </option>
                                <option value="03" <?= ($_GET['bulan'] ?? '') == '03' ? 'selected' : '' ?>>Maret
                                </option>
                                <option value="04" <?= ($_GET['bulan'] ?? '') == '04' ? 'selected' : '' ?>>April
                                </option>
                                <option value="05" <?= ($_GET['bulan'] ?? '') == '05' ? 'selected' : '' ?>>Mei</option>
                                <option value="06" <?= ($_GET['bulan'] ?? '') == '06' ? 'selected' : '' ?>>Juni</option>
                                <option value="07" <?= ($_GET['bulan'] ?? '') == '07' ? 'selected' : '' ?>>Juli</option>
                                <option value="08" <?= ($_GET['bulan'] ?? '') == '08' ? 'selected' : '' ?>>Agustus
                                </option>
                                <option value="09" <?= ($_GET['bulan'] ?? '') == '09' ? 'selected' : '' ?>>September
                                </option>
                                <option value="10" <?= ($_GET['bulan'] ?? '') == '10' ? 'selected' : '' ?>>Oktober
                                </option>
                                <option value="11" <?= ($_GET['bulan'] ?? '') == '11' ? 'selected' : '' ?>>November
                                </option>
                                <option value="12" <?= ($_GET['bulan'] ?? '') == '12' ? 'selected' : '' ?>>Desember
                                </option>
                            </select>

                            <select name="tahun" class="form-control mx-2">
                                <option value="">Pilih Tahun</option>
                                <option value="2025" <?= ($_GET['tahun'] ?? '') == '2025' ? 'selected' : '' ?>>2025
                                </option>
                                <option value="2024" <?= ($_GET['tahun'] ?? '') == '2024' ? 'selected' : '' ?>>2024
                                </option>
                                <option value="2023" <?= ($_GET['tahun'] ?? '') == '2023' ? 'selected' : '' ?>>2023
                                </option>
                                <option value="2022" <?= ($_GET['tahun'] ?? '') == '2022' ? 'selected' : '' ?>>2022
                                </option>
                            </select>

                            <button class="btn btn-primary ml-2">Cari</button>
                        </form>


                    </div>
                    <!-- Filter Form End -->

                    <!-- Tabel -->
                    <table class="table table-bordered table-striped table-hover" id="example1" style="font-size: 12px;">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Penyewa</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status Sewa</th>
                                <th>Qty</th>
                                <th>Ongkir</th>
                                <th>DP</th>
                                <th>Total</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($rentals as $rental): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= esc($rental['transaction_code']) ?></td>
                                <td><?= esc($rental['customer_name']) ?></td>
                                <td><?= esc(date('Y-m-d', strtotime($rental['created_at']))) ?></td>
                                <td class="text-center" >
                                    <?php if ($rental['return_status'] == 1): ?>
                                    <span class="badge badge-success">Selesai</span>
                                    <?php else: ?>
                                    <span class="badge badge-warning">Proses</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $rental['item_count'] ?></td>

                                <td>Rp. <?= number_format($rental['shipping_cost'], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($rental['down_payment'], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($rental['total_price'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <?php if ($rental['payment_status'] == 2): ?>
                                    <span class="badge badge-warning">Pending</span>
                                    <!-- Pending pakai warna warning -->
                                    <?php elseif ($rental['payment_status'] == 1): ?>
                                    <span class="badge badge-success">Lunas</span>
                                    <?php else: ?>
                                    <span class="badge badge-danger">Belum Lunas</span>
                                    <!-- Belum Lunas lebih cocok warna merah -->
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <!-- Tombol Detail -->
                                    <button class="btn btn-info btn-sm btn-detail" data-toggle="modal"
                                        data-target="#modalUpdate" data-id="<?= $rental['id'] ?>"
                                        data-payment_status="<?= $rental['payment_status'] ?>"
                                        data-return_status="<?= $rental['return_status'] ?>"
                                        data-customer_name="<?= $rental['customer_name'] ?>"
                                        data-total_price="<?= $rental['total_price'] ?>"
                                        data-proof_of_payment="<?= $rental['proof_of_payment'] ?>"
                                        data-down_payment="<?= $rental['down_payment'] ?>"
                                        data-discount="<?= esc($rental['discount']) ?>"
                                        data-shipping_cost="<?= esc($rental['shipping_cost']) ?>"
                                        data-borrow_date="<?= esc($rental['items'][0]['borrow_date']) ?>"
                                        data-return_date="<?= esc($rental['items'][0]['return_date']) ?>">
                                        <i class="fas fa-pen" style="font-size: 0.8rem;"></i> <!-- 👁️ Icon untuk "lihat/detail" -->
                                    </button>

                                    <!-- Tombol Cetak -->
                                    <a href="<?= base_url('rental-status/print/' . $rental['id']) ?>"
                                        class="btn btn-primary btn-sm" target="_blank">
                                        <i class="fas fa-print" style="font-size: 0.8rem;"></i> <!-- 🖨️ Icon untuk "cetak" -->
                                    </a>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Modal Detail Transaksi -->
                    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="<?= base_url('rental-status/update-status') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" id="rental_id">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Transaksi</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Tampilkan Data Transaksi -->
                                        <input type="hidden" name="total_price" id="total_price">

                                        <div class="form-group">
                                            <label for="transaction_code">ID Transaksi</label>
                                            <input type="text" class="form-control" id="transaction_code"
                                                value="<?= esc($rental['transaction_code']) ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer_name">Nama Penyewa</label>
                                            <input type="text" class="form-control" id="customer_name"
                                                value="<?= esc($rental['customer_name']) ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control" id="address"
                                                value="<?= esc($rental['address']) ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="shipping_cost">Ongkir</label>
                                            <input type="number" class="form-control" id="shipping_cost"
                                                name="shipping_cost" value="<?= esc($rental['shipping_cost']) ?>">

                                        </div>

                                        <!-- Dropdown untuk Status Pembayaran dan Sewa -->
                                        <div class="form-group">
                                            <label for="payment_status">Status Pembayaran</label>
                                            <select name="payment_status" class="form-control" id="payment_status">
                                                <option value="2"
                                                    <?= $rental['payment_status'] == 2 ? 'selected' : '' ?>>Pending
                                                </option>
                                                <option value="1"
                                                    <?= $rental['payment_status'] == 1 ? 'selected' : '' ?>>Lunas
                                                </option>
                                                <option value="0"
                                                    <?= $rental['payment_status'] == 0 ? 'selected' : '' ?>>Belum Lunas
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="return_status">Status Sewa</label>
                                            <select name="return_status" class="form-control" id="return_status">
                                                <option value="1"
                                                    <?= $rental['return_status'] == 1 ? 'selected' : '' ?>>Sudah
                                                    Dikembalikan</option>
                                                <option value="0"
                                                    <?= $rental['return_status'] == 0 ? 'selected' : '' ?>>Belum
                                                    Dikembalikan</option>
                                            </select>
                                        </div>

                                        <!-- Tampilkan Barang yang Disewa -->
                                        <h5>Barang yang Disewa</h5>
                                        <table class="table table-bordered" id="itemsDetailTable">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Tanggal Pinjam</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rental['items'] as $item): ?>
                                                <tr>
                                                    <td><?= esc($item['item_name']) ?></td>
                                                    <td><?= esc($item['quantity']) ?></td>
                                                    <td><?= esc(date('Y-m-d', strtotime($item['borrow_date']))) ?></td>
                                                    <td><?= esc(date('Y-m-d', strtotime($item['return_date']))) ?></td>
                                                    <td class="item-price">Rp.
                                                        <?= number_format($item['price'], 0, ',', '.') ?></td>
                                                    <!-- ✅ tambahkan class -->
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <!-- 🔥 Ini baris baru untuk total -->
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4" class="text-right">Total Harga Barang:</th>
                                                    <th id="totalItemsPrice">Rp. 0</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4" class="text-right">Diskon</th>
                                                    <th id="diskonValue">Rp. 0</th> <!-- 🔥 kasih ID -->
                                                </tr>
                                                <tr>
                                                    <th colspan="4" class="text-right">Ongkir</th>
                                                    <th id="ongkirValue">Rp. 0</th> <!-- 🔥 kasih ID -->
                                                </tr>
                                                <tr>
                                                    <th colspan="4" class="text-right">Total</th>
                                                    <th id="totalHargaSemua">Rp. 0</th> <!-- 🔥 kasih ID ini buat JS -->
                                                </tr>
                                            </tfoot>



                                        </table>


                                        <div class="form-group text-center">
                                            <label>Bukti Transfer</label><br>

                                            <!-- Tempat gambar -->
                                            <img id="proof_of_payment_img"
                                                src="<?= base_url('show/payment/' . $rental['proof_of_payment']) ?>"
                                                alt="Bukti Transfer" class="img-fluid rounded mb-2"
                                                style="max-height: 600px; object-fit: cover; display: none;">

                                            <!-- Input Upload (hanya muncul kalau gambar tidak ada) -->
                                            <input type="file" name="proof_of_payment" class="form-control-file mt-2"
                                                id="uploadProofInput" style="display: none;" accept="image/*">
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function getRentalDays(borrowDateStr, returnDateStr) {
        var borrowDate = new Date(borrowDateStr);
        var returnDate = new Date(returnDateStr);

        if (isNaN(borrowDate) || isNaN(returnDate)) {
            return 1;
        }

        var timeDiff = returnDate.getTime() - borrowDate.getTime();
        var days = Math.floor(timeDiff / (1000 * 3600 * 24)) + 1;

        return days > 0 ? days : 1;
    }


    function calculateTotalItemPrice(rentalDays, discount, shippingCost) {
        let total = 0;

        $('#itemsDetailTable tbody tr').each(function() {
            const priceText = $(this).find('.item-price').text().replace(/[Rp.\s]/g, '').replace(',',
                '');
            const price = parseFloat(priceText) || 0;
            total += price;
        });

        const totalBarang = total * rentalDays;
        const finalTotal = (totalBarang - discount) + shippingCost;

        // Update tampilan di <tfoot>
        $('#totalItemsPrice').text("Rp. " + totalBarang.toLocaleString('id-ID') + " x " + rentalDays + " hari");
        $('#diskonValue').text("Rp. - " + discount.toLocaleString('id-ID')); // 🔥 update diskon
        $('#ongkirValue').text("Rp. + " + shippingCost.toLocaleString('id-ID')); // 🔥 update ongkir
        $('#totalHargaSemua').text("Rp. " + finalTotal.toLocaleString('id-ID')); // 🔥 update total semua
        // 🔥 Ini yang WAJIB ditambahkan agar total_price dikirim ke server
        $('#total_price').val(finalTotal);
    }


    $('#modalUpdate').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var payment_status = button.data('payment_status');
        var return_status = button.data('return_status');
        var customer_name = button.data('customer_name');
        var total_price = button.data('total_price');
        var proof_of_payment = button.data('proof_of_payment');
        var down_payment = button.data('down_payment');
        var discount = parseFloat(button.data('discount')) || 0;
        var shippingCost = parseFloat(button.data('shipping_cost')) || 0;


        // 🔥 ini yang harus ditambahkan
        var borrow_date = button.data('borrow_date');
        var return_date = button.data('return_date');

        var modal = $(this);

        if (proof_of_payment) {
            $('#proof_of_payment_img').attr('src', '<?= base_url('show/payment/') ?>' +
                proof_of_payment).show();
            $('#uploadProofInput').hide();
        } else {
            $('#proof_of_payment_img').hide();
            $('#uploadProofInput').show();
        }

        modal.find('#rental_id').val(id);
        modal.find('#payment_status').val(payment_status);
        modal.find('#return_status').val(return_status);
        modal.find('#customer_name').val(customer_name);
        //modal.find('#total_price').val("Rp. " + new Intl.NumberFormat('id-ID').format(total_price));
        modal.find('#total_price').val(total_price);
        modal.find('#proof_of_payment').val(proof_of_payment);
        modal.find('#down_payment').val("Rp. " + new Intl.NumberFormat('id-ID').format(down_payment));
        modal.find('#discount').val("Rp. " + discount.toLocaleString('id-ID'));
        //modal.find('#shipping_cost').val("Rp. " + shippingCost.toLocaleString('id-ID'));
        modal.find('#shipping_cost').val(shippingCost);



        // ✅ ini baru benar
        var rentalDays = getRentalDays(borrow_date, return_date);

        // yang ini ubah
        calculateTotalItemPrice(rentalDays, discount, shippingCost);

    });


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

.ml-auto {
    margin-left: auto;
}

.text-right {
    text-align: right;
}

</style>

<?= $this->endSection() ?>