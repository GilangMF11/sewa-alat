<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-cash-register"></i> Form Transaksi</h1>
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
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('errors') ?>
                </div>
            <?php endif; ?>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Data Transaksi</h3>
                </div>
                <form action="<?= base_url('order/store') ?>" method="post" enctype="multipart/form-data" id="transactionForm">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="customer_name"><i class="fas fa-user"></i> Nama Penyewa</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Masukkan Nama Penyewa" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="borrow_date"><i class="fas fa-calendar-plus"></i> Tanggal Pinjam</label>
                                <input type="date" name="borrow_date" id="borrow_date" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="return_date"><i class="fas fa-calendar-check"></i> Tanggal Kembali</label>
                                <input type="date" name="return_date" id="return_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address"><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Masukkan alamat lengkap">
                        </div>

                        <div class="form-group">
                            <label for="shipping_cost"><i class="fas fa-truck"></i> Biaya Pengiriman (Rp)</label>
                            <input type="number" name="shipping_cost" id="shipping_cost" class="form-control" placeholder="Contoh: 100000">
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-boxes"></i> Barang yang Disewa</label>
                            <table class="table table-bordered table-sm" id="itemsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Barang</th>
                                        <th width="15%">Jumlah</th>
                                        <th width="20%">Harga</th>
                                        <th width="5%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="items[0][item_id]" class="form-control item-select" required>
                                                <option value="">-- Pilih Barang --</option>
                                                <?php foreach ($products as $item): ?>
                                                    <option value="<?= $item['id'] ?>" data-price="<?= $item['price'] ?>">
                                                        <?= $item['name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><input type="number" name="items[0][quantity]" class="form-control quantity" value="1" min="1" required></td>
                                        <td><input type="text" name="items[0][price]" class="form-control price" readonly></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger remove-item">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-sm btn-success" id="addItem">
                                <i class="fas fa-plus"></i> Tambah Barang
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="payment_method"><i class="fas fa-wallet"></i> Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Kartu Kredit</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        


                        <div class="form-group">
                            <label for="proof_of_payment"><i class="fas fa-image"></i> Upload Bukti Pembayaran</label>
                            <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="discount"><i class="fas fa-tags"></i> Potongan Harga (Rp)</label>
                            <input type="number" name="discount" id="discount" class="form-control" value="0">
                        </div>

                        <div class="form-group">
                            <label for="total_price_display"><i class="fas fa-receipt"></i> Total Harga</label>
                            <input type="text" id="total_price_display" class="form-control" readonly>
                            <input type="hidden" name="total_price" id="total_price">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- Tambahkan FontAwesome jika belum -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    let itemIndex = 1;

    document.getElementById('addItem').addEventListener('click', function() {
        const tableBody = document.querySelector('#itemsTable tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="items[${itemIndex}][item_id]" class="form-control item-select" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($products as $item): ?>
                        <option value="<?= $item['id'] ?>" data-price="<?= $item['price'] ?>"><?= $item['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="number" name="items[${itemIndex}][quantity]" class="form-control quantity" value="1" min="1" required></td>
            <td><input type="text" name="items[${itemIndex}][price]" class="form-control price" readonly></td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger remove-item"><i class="fas fa-times"></i></button>
            </td>
        `;
        tableBody.appendChild(newRow);

        newRow.querySelector('.remove-item').addEventListener('click', function() {
            newRow.remove();
            updateTotalPrice();
        });

        newRow.querySelector('.item-select').addEventListener('change', function() {
            updateItemPrice(this);
        });

        newRow.querySelector('.quantity').addEventListener('input', function() {
            const select = newRow.querySelector('.item-select');
            updateItemPrice(select);
        });

        itemIndex++;
    });

    // Update harga total per item saat dipilih
    window.updateItemPrice = function(selectElement) {
        const row = selectElement.closest('tr');
        const priceInput = row.querySelector('.price');
        const quantityInput = row.querySelector('.quantity');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const unitPrice = selectedOption ? parseInt(selectedOption.getAttribute('data-price')) || 0 : 0;
        const quantity = parseInt(quantityInput.value) || 1;
        const totalPrice = unitPrice * quantity;

        priceInput.value = formatCurrency(totalPrice);
        updateTotalPrice();
    };

    // Hitung total harga semua barang
    function updateTotalPrice() {
        let totalPrice = 0;

        document.querySelectorAll('#itemsTable tbody tr').forEach(row => {
            const price = parseFloat(row.querySelector('.price').value.replace(/\./g, '')) || 0;
            totalPrice += price;
        });

        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const finalPrice = totalPrice - discount;

        document.getElementById('total_price_display').value = formatCurrency(finalPrice);
        document.getElementById('total_price').value = finalPrice;
    }


    function formatCurrency(value) {
        return value.toLocaleString('id-ID');
    }

    // Init awal
    document.querySelectorAll('.item-select').forEach(select => {
        select.addEventListener('change', function() {
            updateItemPrice(this);
        });
    });

    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('input', function() {
            const row = this.closest('tr');
            const select = row.querySelector('.item-select');
            updateItemPrice(select);
        });
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
