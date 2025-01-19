<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('rental/create') ?>" method="post" id="transactionForm">
                            <div class="form-group">
                                <label for="user_id">Pilih Penyewa</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="1">John Doe</option>
                                    <option value="2">Jane Smith</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="borrow_date">Tanggal Pinjam</label>
                                <input type="date" name="borrow_date" id="borrow_date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="return_date">Tanggal Kembali</label>
                                <input type="date" name="return_date" id="return_date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="shipping_cost">Biaya Pengiriman</label>
                                <input type="number" name="shipping_cost" id="shipping_cost" class="form-control" placeholder="Masukkan biaya pengiriman">
                            </div>

                            <div class="form-group">
                                <label>Barang yang Disewa</label>
                                <table class="table table-bordered" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="items[0][item_id]" class="form-control">
                                                    <option value="1">Laptop</option>
                                                    <option value="2">Kamera</option>
                                                </select>
                                            </td>
                                            <td><input type="number" name="items[0][quantity]" class="form-control" placeholder="Jumlah"></td>
                                            <td><input type="number" name="items[0][price]" class="form-control" placeholder="Harga"></td>
                                            <td><button type="button" class="btn btn-danger remove-item">Hapus</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-success" id="addItem">Tambah Barang</button>
                            </div>

                            <div class="form-group">
                                <label for="payment_method">Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" class="form-control">
                                    <option value="cash">Cash</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                    <option value="transfer">Transfer Bank</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="total_price">Total Harga</label>
                                <input type="number" name="total_price" id="total_price" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let itemIndex = 1;

            // Tambah barang baru
            document.getElementById('addItem').addEventListener('click', function() {
                const tableBody = document.querySelector('#itemsTable tbody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>
                        <select name="items[${itemIndex}][item_id]" class="form-control">
                            <option value="1">Laptop</option>
                            <option value="2">Kamera</option>
                        </select>
                    </td>
                    <td><input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="Jumlah"></td>
                    <td><input type="number" name="items[${itemIndex}][price]" class="form-control" placeholder="Harga"></td>
                    <td><button type="button" class="btn btn-danger remove-item">Hapus</button></td>
                `;
                tableBody.appendChild(newRow);
                itemIndex++;
            });

            // Hapus barang
            document.querySelector('#itemsTable').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-item')) {
                    e.target.closest('tr').remove();
                }
            });

            // Hitung total harga secara dinamis
            document.querySelector('#transactionForm').addEventListener('input', function() {
                let total = 0;
                document.querySelectorAll('#itemsTable tbody tr').forEach(function(row) {
                    const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
                    const price = parseFloat(row.querySelector('input[name*="[price]"]').value) || 0;
                    total += quantity * price;
                });
                document.getElementById('total_price').value = total;
            });

            // Mengatur tanggal kembali otomatis
            document.getElementById('borrow_date').addEventListener('change', function() {
                const borrowDate = new Date(this.value);
                if (!isNaN(borrowDate.getTime())) {
                    // Menambahkan 3 hari ke tanggal pinjam
                    borrowDate.setDate(borrowDate.getDate() + 3);
                    const returnDate = borrowDate.toISOString().split('T')[0]; // format YYYY-MM-DD
                    document.getElementById('return_date').value = returnDate;
                }
            });
        });
    </script>
<?= $this->endSection() ?>
