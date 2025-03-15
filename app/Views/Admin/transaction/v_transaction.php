<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
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

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Transaksi</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('rental/create') ?>" method="post" id="transactionForm">

                        <div class="form-group">
                            <label for="customer_name">Penyewa</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control"
                                placeholder="Masukkan Nama Penyewa">
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
                            <input type="number" name="shipping_cost" id="shipping_cost" class="form-control"
                                placeholder="Masukkan biaya pengiriman">
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
                                            <select name="items[0][item_id]" class="form-control item-select">
                                                <option value="">-- Pilih Barang --</option>
                                                <?php foreach ($products as $item): ?>
                                                <option value="<?= $item['id'] ?>" data-price="<?= $item['price'] ?>">
                                                    <?= $item['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><input type="number" name="items[0][quantity]" class="form-control quantity"
                                                placeholder="Jumlah" value="1"></td>
                                        <td><input type="number" name="items[0][price]" class="form-control price"
                                                placeholder="Harga" readonly></td>
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
                            <label for="total_price_display">Total Harga</label>
                            <input type="text" id="total_price_display" class="form-control" readonly>
                            <input type="hidden" name="total_price" id="total_price">
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemIndex = 1;

    document.getElementById('addItem').addEventListener('click', function() {
        const tableBody = document.querySelector('#itemsTable tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="items[${itemIndex}][item_id]" class="form-control item-select">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($products as $item): ?>
                        <option value="<?= $item['id'] ?>" data-price="<?= $item['price'] ?>"><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="number" name="items[${itemIndex}][quantity]" class="form-control quantity" value="1" min="1"></td>
            <td><input type="text" name="items[${itemIndex}][price]" class="form-control price" readonly></td>
            <td><button type="button" class="btn btn-danger remove-item">Hapus</button></td>
        `;
        tableBody.appendChild(newRow);

        newRow.querySelector('.remove-item').addEventListener('click', function() {
            newRow.remove();
            updateTotalPrice();
        });

        newRow.querySelector('.item-select').addEventListener('change', function() {
            updateItemPrice(this);
        });

        newRow.querySelector('.quantity').addEventListener('input', updateTotalPrice);

        itemIndex++;
    });

    // Fungsi untuk mengupdate harga saat barang dipilih
    window.updateItemPrice = function(selectElement) {
        const row = selectElement.closest('tr');
        const priceInput = row.querySelector('.price');
        const quantityInput = row.querySelector('.quantity');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const price = selectedOption ? parseInt(selectedOption.getAttribute('data-price')) || 0 : 0;

        priceInput.value = formatCurrency(price);

        if (!quantityInput.value || quantityInput.value == "0") {
            quantityInput.value = 1;
        }
        updateTotalPrice();
    };

    // Fungsi untuk menghitung total harga
    function updateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('#itemsTable tbody tr').forEach(row => {
            const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
            const price = parseFloat(row.querySelector('.price').value.replace(/\./g, '')) || 0; // Menghapus titik sebelum perhitungan
            totalPrice += quantity * price;
        });

        document.getElementById('total_price_display').value = formatCurrency(totalPrice); // Tampilkan di input text
        document.getElementById('total_price').value = totalPrice; // Simpan dalam hidden input (untuk form submit)
    }

    // Fungsi untuk mengubah angka menjadi format "1.140.000"
    function formatCurrency(value) {
        return value.toLocaleString('id-ID'); // Format angka dengan titik sebagai pemisah ribuan
    }

    document.querySelectorAll('.item-select').forEach(select => {
        select.addEventListener('change', function() {
            updateItemPrice(this);
        });
    });

    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('input', updateTotalPrice);
    });

    document.querySelector('#itemsTable').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('tr').remove();
            updateTotalPrice();
        }
    });

    document.getElementById('borrow_date').addEventListener('change', function() {
        const borrowDate = new Date(this.value);
        if (!isNaN(borrowDate.getTime())) {
            borrowDate.setDate(borrowDate.getDate() + 3);
            document.getElementById('return_date').value = borrowDate.toISOString().split('T')[0];
        }
    });
});

</script>

<?= $this->endSection() ?>