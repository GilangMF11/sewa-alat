<?= $this->extend('layouts/v_wrapper') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Header Section -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 display-4 font-weight-bold text-primary">
                        <i class="fas fa-shopping-cart mr-3"></i>Checkout
                    </h1>
                    <p class="text-muted">Lengkapi data untuk menyelesaikan penyewaan</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/cart') ?>">Keranjang</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Progress Bar -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="checkout-progress">
                                <div class="progress-step active">
                                    <div class="step-circle">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <span>Keranjang</span>
                                </div>
                                <div class="progress-line active"></div>
                                <div class="progress-step active">
                                    <div class="step-circle">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <span>Checkout</span>
                                </div>
                                <div class="progress-line"></div>
                                <div class="progress-step">
                                    <div class="step-circle">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <span>Pembayaran</span>
                                </div>
                                <div class="progress-line"></div>
                                <div class="progress-step">
                                    <div class="step-circle">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span>Selesai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="<?= base_url('user/checkout/store') ?>" method="post" id="checkoutForm">
                <?= csrf_field() ?>
                <input type="hidden" name="duration" id="durationHidden">

                <div class="row">
                    <!-- Form Data -->
                    <div class="col-lg-8">
                        <!-- Data Penyewa -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-gradient-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-user mr-2"></i>
                                    Data Penyewa
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-user text-primary"></i>
                                                Nama Penyewa <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="customer_name" class="form-control form-control-lg"
                                                required value="<?= session('name') ?>"
                                                placeholder="Masukkan nama lengkap">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-phone text-success"></i>
                                                No. Telepon <span class="text-danger">*</span>
                                            </label>
                                            <input type="tel" name="phone" class="form-control form-control-lg"
                                                placeholder="Nomor telepon" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-map-marker-alt text-danger"></i>
                                        Alamat Penyewa <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="address" class="form-control" rows="3" required
                                        placeholder="Masukkan alamat lengkap untuk pengiriman/penjemputan"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Data Sewa -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-gradient-info text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    Periode Sewa
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-calendar-plus text-success"></i>
                                                Tanggal Pinjam <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="borrow_date" class="form-control form-control-lg"
                                                id="borrow_date" required min="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-calendar-minus text-warning"></i>
                                                Tanggal Kembali <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="return_date" class="form-control form-control-lg"
                                                id="return_date" required min="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- Duration Display -->
                                <div class="alert alert-info" id="durationAlert" style="display: none;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock text-info mr-2"></i>
                                        <div>
                                            <strong>Durasi Sewa: <span id="durationDays">0</span> hari</strong>
                                            <br>
                                            <small>Harga akan dihitung berdasarkan durasi sewa</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update bagian Shipping Cost dengan styling yang lebih baik -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-gradient-secondary text-white">
        <h5 class="mb-0">
            <i class="fas fa-shipping-fast mr-2"></i>
            Jenis Pengiriman
        </h5>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-truck text-info"></i>
                Pilih Pengiriman <span class="text-danger">*</span>
            </label>
            <select name="shipping_cost" class="form-control form-control-lg" required>
                <option value="" disabled selected>-- Pilih Jenis Pengiriman --</option>
                <option value="0">🏪 Ambil ke Lokasi (Gratis)</option>
                <option value="200000">🚚 Dalam Kota Purwokerto (Rp 200.000)</option>
                <option value="500000">🚛 Luar Kota Purwokerto (Rp 500.000)</option>
            </select>
            <small class="form-text text-muted">
                <i class="fas fa-info-circle"></i>
                Ongkos kirim akan ditambahkan ke total pembayaran
            </small>
        </div>

        <!-- Info Box untuk Shipping -->
        <div class="alert alert-info mt-3" id="shippingInfo" style="display: none;">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle mr-2"></i>
                <div id="shippingInfoText">
                    Ongkos kirim dapat <strong>dinegosiasikan</strong> melalui <a href="https://wa.me/6282188865677" target="_blank" class="text-success font-weight-bold">WhatsApp Admin</a>.
                </div>
            </div>
        </div>
    </div>
</div>


                        <!-- Lanjutkan dengan blok Metode Pembayaran -->

                        <!-- Metode Pembayaran -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-gradient-warning text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-credit-card mr-2"></i>
                                    Metode Pembayaran
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="payment-methods">
                                    <div class="custom-control custom-radio payment-option">
                                        <input class="custom-control-input" type="radio" id="transfer" name="payment_type" value="2" checked>
                                        <label for="transfer" class="custom-control-label payment-label">
                                            <div class="payment-card">
                                                <div class="payment-icon">
                                                    <i class="fas fa-university text-primary"></i>
                                                </div>
                                                <div class="payment-details">
                                                    <h6>Transfer Bank</h6>
                                                    <small class="text-muted">BCA, Mandiri, BRI, BNI</small>
                                                </div>
                                                <div class="payment-badge">
                                                    <span class="badge badge-success">Rekomendasi</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="custom-control custom-radio payment-option">
                                        <input class="custom-control-input" type="radio" id="cash" name="payment_type" value="1">
                                        <label for="cash" class="custom-control-label payment-label">
                                            <div class="payment-card">
                                                <div class="payment-icon">
                                                    <i class="fas fa-money-bill-wave text-success"></i>
                                                </div>
                                                <div class="payment-details">
                                                    <h6>Cash/Tunai</h6>
                                                    <small class="text-muted">Bayar saat pengambilan</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Shipping Notice -->
                                <div class="shipping-notice mt-3">
                                    <div class="alert alert-warning">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-truck text-warning mr-2"></i>
                                            <div>
                                                <strong>Informasi Ongkir:</strong>
                                                <span class="blink-text">Bisa Dinegosiasi lewat <a href="https://wa.me/6282188865677" target="_blank" class="text-success font-weight-bold">Whatsapp</a></span>
                                                <br>
                                                <small>Ongkir akan ditentukan berdasarkan lokasi pengiriman</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm sticky-top">
                            <div class="card-header bg-gradient-success text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-receipt mr-2"></i>
                                    Ringkasan Pesanan
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Product List -->
                                <div class="order-items" id="summaryList">
                                    <?php $total = 0;
                                    foreach ($cartItems as $item): ?>
                                        <?php
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total += $subtotal;
                                        ?>
                                        <div class="order-item product-item"
                                            data-price="<?= $item['price'] ?>"
                                            data-qty="<?= $item['quantity'] ?>">
                                            <div class="item-info">
                                                <h6 class="item-name"><?= esc($item['name']) ?></h6>
                                                <div class="item-meta">
                                                    <span class="quantity">Qty: <?= esc($item['quantity']) ?></span>
                                                    <span class="price">@ Rp <?= number_format($item['price'], 0, ',', '.') ?></span>
                                                </div>
                                            </div>
                                            <div class="item-total">
                                                Rp <?= number_format($subtotal, 0, ',', '.') ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>


                                <!-- Update bagian Order Summary di checkout -->
                                <div class="order-summary">
                                    <div class="summary-line">
                                        <span><i class="fas fa-shopping-cart mr-2"></i>Subtotal Produk</span>
                                        <span id="subtotalDisplay">Rp <?= number_format($total, 0, ',', '.') ?></span>
                                    </div>
                                    <div class="summary-line">
                                        <span><i class="fas fa-clock mr-2"></i>Durasi Sewa</span>
                                        <span id="durationDisplay">1 hari</span>
                                    </div>
                                    <div class="summary-line">
                                        <span><i class="fas fa-truck mr-2"></i>Ongkos Kirim</span>
                                        <span class="text-muted">Pilih jenis pengiriman</span>
                                    </div>
                                    <hr>
                                    <div class="summary-total">
                                        <span><i class="fas fa-calculator mr-2"></i>Total Pembayaran</span>
                                        <span id="totalPriceDisplay">Rp <?= number_format($total, 0, ',', '.') ?></span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="checkout-actions mt-4">
                                    <a href="<?= base_url('user/cart') ?>" class="btn btn-outline-secondary btn-block mb-3">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Kembali ke Keranjang
                                    </a>
                                    <button type="submit" class="btn btn-success btn-lg btn-block checkout-btn">
                                        <i class="fas fa-credit-card mr-2"></i>
                                        Proses Checkout
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>

                                <!-- Trust Indicators -->
                                <div class="trust-indicators mt-3">
                                    <div class="trust-item">
                                        <i class="fas fa-shield-alt text-success"></i>
                                        <small>Transaksi Aman</small>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-clock text-info"></i>
                                        <small>Konfirmasi Cepat</small>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-headset text-warning"></i>
                                        <small>Support 24/7</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const borrowDateInput = document.getElementById('borrow_date');
        const returnDateInput = document.getElementById('return_date');
        const durationAlert = document.getElementById('durationAlert');
        const durationDays = document.getElementById('durationDays');
        const durationDisplay = document.getElementById('durationDisplay');
        const shippingSelect = document.querySelector('select[name="shipping_cost"]');
        const shippingInfo = document.getElementById('shippingInfo');
        const shippingInfoText = document.getElementById('shippingInfoText');

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        borrowDateInput.min = today;

        if (shippingSelect) {
        shippingSelect.addEventListener('change', function () {
            if (this.value !== "") {
                shippingInfo.style.display = 'block';
            } else {
                shippingInfo.style.display = 'none';
            }
        });
    }

        // Update return date minimum when borrow date changes
        borrowDateInput.addEventListener('change', function() {
            returnDateInput.min = this.value;
            if (returnDateInput.value && returnDateInput.value < this.value) {
                returnDateInput.value = this.value;
            }
            calculateTotal();
        });

        returnDateInput.addEventListener('change', calculateTotal);

        // Update total when shipping option changes
        shippingSelect.addEventListener('change', function() {
            updateShippingCost();
            showShippingInfo();
        });

        function calculateTotal() {
            const borrowDate = new Date(borrowDateInput.value);
            const returnDate = new Date(returnDateInput.value);

            if (!isNaN(borrowDate) && !isNaN(returnDate) && returnDate >= borrowDate) {
                const oneDay = 24 * 60 * 60 * 1000;
                const duration = Math.max(1, Math.round((returnDate - borrowDate) / oneDay) + 1);

                // Update duration display
                durationDays.textContent = duration;
                durationDisplay.textContent = duration + ' hari';
                durationAlert.style.display = 'block';

                // Calculate new prices
                let subtotal = 0;
                document.querySelectorAll('.product-item').forEach(el => {
                    const price = parseInt(el.dataset.price);
                    const qty = parseInt(el.dataset.qty);
                    const itemTotal = price * qty * duration;
                    subtotal += itemTotal;

                    el.querySelector('.item-total').textContent = formatRupiah(itemTotal);
                });

                // Update subtotal
                document.getElementById('subtotalDisplay').textContent = formatRupiah(subtotal);

                // Update total with current shipping cost
                updateTotal(subtotal);
            } else {
                durationAlert.style.display = 'none';
            }
        }

        function updateShippingCost() {
            // Get current subtotal
            const subtotalText = document.getElementById('subtotalDisplay').textContent;
            const subtotal = parseInt(subtotalText.replace(/[^\d]/g, '')) || 0;

            // Update shipping cost display
            const shippingCost = parseInt(shippingSelect.value) || 0;
            const shippingDisplay = document.querySelector('.summary-line:nth-child(3) span:last-child');

            if (shippingCost === 0) {
                shippingDisplay.innerHTML = '<span class="text-success font-weight-bold">Gratis (Ambil Sendiri)</span>';
            } else {
                shippingDisplay.innerHTML = `<span class="text-primary font-weight-bold">${formatRupiah(shippingCost)}</span>`;
            }

            // Update total
            updateTotal(subtotal);
        }

        function updateTotal(subtotal) {
            const shippingCost = parseInt(shippingSelect.value) || 0;
            const total = subtotal + shippingCost;

            document.getElementById('totalPriceDisplay').textContent = formatRupiah(total);

            // Update checkout button with total
            const checkoutBtn = document.querySelector('.checkout-btn');
            if (total > 0) {
                checkoutBtn.innerHTML = `
                <i class="fas fa-credit-card mr-2"></i>
                Bayar ${formatRupiah(total)}
                <i class="fas fa-arrow-right ml-2"></i>
            `;
                checkoutBtn.disabled = false;
            } else {
                checkoutBtn.innerHTML = `
                <i class="fas fa-credit-card mr-2"></i>
                Proses Checkout
                <i class="fas fa-arrow-right ml-2"></i>
            `;
            }
        }

        function showShippingInfo() {
            const shippingCost = parseInt(shippingSelect.value);

            if (shippingSelect.value !== "") {
                shippingInfo.style.display = 'block';

                switch (shippingCost) {
                    case 0:
                        shippingInfoText.innerHTML = `
                        <strong>Ambil ke Lokasi</strong><br>
                        <small>📍 Alamat: Jl. Budaya Jawa No. 123, Purwokerto<br>
                        ⏰ Jam Operasional: Senin-Sabtu 08:00-17:00</small>
                    `;
                        break;
                    case 200000:
                        shippingInfoText.innerHTML = `
                        <strong>Pengiriman Dalam Kota</strong><br>
                        <small>🚚 Area: Purwokerto dan sekitarnya<br>
                        ⏱️ Estimasi: 1-2 hari kerja</small>
                    `;
                        break;
                    case 500000:
                        shippingInfoText.innerHTML = `
                        <strong>Pengiriman Luar Kota</strong><br>
                        <small>🚛 Area: Luar Purwokerto (Jawa Tengah)<br>
                        ⏱️ Estimasi: 2-3 hari kerja</small>
                    `;
                        break;
                }
            } else {
                shippingInfo.style.display = 'none';
            }
        }

        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        // Form submission with validation and processing
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validasi shipping cost
            if (!shippingSelect.value && shippingSelect.value !== "0") {
                alert('Silakan pilih jenis pengiriman terlebih dahulu');
                shippingSelect.focus();
                return;
            }

            // Get duration and calculate final prices
            const duration = parseInt(durationDays.textContent) || 1;
            document.getElementById('durationHidden').value = duration;

            // Update semua harga di form hidden inputs
            document.querySelectorAll('.product-item').forEach((el, index) => {
                const originalPrice = parseInt(el.dataset.price);
                const newPrice = originalPrice * duration;

                // Buat hidden input untuk harga baru
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `item_prices[${index}]`;
                hiddenInput.value = newPrice;
                this.appendChild(hiddenInput);
            });

            // Add loading state
            const submitBtn = document.querySelector('.checkout-btn');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses Transaksi...';
            submitBtn.disabled = true;

            // Submit form
            this.submit();
        });

        // Form validation enhancement
        const form = document.getElementById('checkoutForm');
        const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');

        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });

        // Initialize dengan trigger change untuk shipping cost
        if (shippingSelect.value) {
            updateShippingCost();
            showShippingInfo();
        }
    });
</script>
<style>
    /* Progress Bar */
    .checkout-progress {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .progress-step.active .step-circle {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        transform: scale(1.1);
    }

    .progress-step span {
        font-size: 12px;
        font-weight: 500;
        color: #6c757d;
    }

    .progress-step.active span {
        color: #007bff;
        font-weight: 600;
    }

    .progress-line {
        width: 100px;
        height: 2px;
        background: #e9ecef;
        margin: 0 20px;
        margin-top: -25px;
    }

    .progress-line.active {
        background: linear-gradient(90deg, #007bff, #0056b3);
    }

    /* Payment Methods */
    .payment-option {
        margin-bottom: 15px;
    }

    .payment-card {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        background: white;
    }

    .payment-card:hover {
        border-color: #007bff;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.15);
    }

    .custom-control-input:checked~.payment-label .payment-card {
        border-color: #007bff;
        background: linear-gradient(135deg, #f8f9ff, #e3f2fd);
    }

    .payment-icon {
        font-size: 24px;
        margin-right: 15px;
    }

    .payment-details {
        flex: 1;
    }

    .payment-details h6 {
        margin: 0;
        font-weight: 600;
        color: #495057;
    }

    .payment-badge {
        margin-left: 10px;
    }

    /* Order Items */
    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-info h6 {
        margin: 0 0 5px 0;
        font-size: 14px;
        font-weight: 600;
        color: #495057;
    }

    .item-meta {
        display: flex;
        gap: 10px;
        font-size: 12px;
        color: #6c757d;
    }

    .item-total {
        font-weight: 600;
        color: #28a745;
        font-size: 14px;
    }

    /* Order Summary */
    .order-summary {
        margin-top: 20px;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 18px;
        font-weight: 700;
        color: #28a745;
    }

    /* Trust Indicators */
    .trust-indicators {
        display: flex;
        justify-content: space-around;
        padding: 15px 0;
        border-top: 1px solid #f0f0f0;
    }

    .trust-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }

    .trust-item i {
        font-size: 18px;
    }

    /* Gradients */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    }

    /* Form Enhancements */
    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #495057;
    }

    .form-control-lg {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Animations */
    .blink-text {
        color: #dc3545;
        font-weight: bold;
        animation: blink-animation 1.5s ease-in-out infinite;
    }

    @keyframes blink-animation {

        0%,
        50% {
            opacity: 1;
        }

        51%,
        100% {
            opacity: 0.3;
        }
    }

    .checkout-btn {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    /* Card Hover Effects */
    .card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    /* Sticky Sidebar */
    .sticky-top {
        top: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .checkout-progress {
            flex-wrap: wrap;
            gap: 10px;
        }

        .progress-line {
            display: none;
        }

        .payment-card {
            flex-direction: column;
            text-align: center;
        }

        .payment-icon {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .order-item {
            flex-direction: column;
            gap: 10px;
        }

        .trust-indicators {
            flex-direction: column;
            gap: 10px;
        }
    }

    /* Loading State */
    .checkout-btn.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .checkout-btn.loading::after {
        content: "";
        width: 16px;
        height: 16px;
        margin-left: 10px;
        border: 2px solid transparent;
        border-top: 2px solid #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const borrowDateInput = document.getElementById('borrow_date');
        const returnDateInput = document.getElementById('return_date');
        const durationAlert = document.getElementById('durationAlert');
        const durationDays = document.getElementById('durationDays');
        const durationDisplay = document.getElementById('durationDisplay');

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        borrowDateInput.min = today;

        // Update return date minimum when borrow date changes
        borrowDateInput.addEventListener('change', function() {
            returnDateInput.min = this.value;
            if (returnDateInput.value && returnDateInput.value < this.value) {
                returnDateInput.value = this.value;
            }
            calculateDays();
        });

        returnDateInput.addEventListener('change', calculateDays);

        function calculateDays() {
            const borrowDate = new Date(borrowDateInput.value);
            const returnDate = new Date(returnDateInput.value);

            if (!isNaN(borrowDate) && !isNaN(returnDate) && returnDate >= borrowDate) {
                const oneDay = 24 * 60 * 60 * 1000;
                const duration = Math.max(1, Math.round((returnDate - borrowDate) / oneDay) + 1);

                // Update duration display
                durationDays.textContent = duration;
                durationDisplay.textContent = duration + ' hari';
                durationAlert.style.display = 'block';

                // Calculate new prices
                let total = 0;
                document.querySelectorAll('.product-item').forEach(el => {
                    const price = parseInt(el.dataset.price);
                    const qty = parseInt(el.dataset.qty);
                    const subtotal = price * qty * duration;
                    total += subtotal;

                    el.querySelector('.item-total').textContent = formatRupiah(subtotal);
                });

                // Update totals
                document.getElementById('subtotalDisplay').textContent = formatRupiah(total);
                document.getElementById('totalPriceDisplay').textContent = formatRupiah(total);
            } else {
                durationAlert.style.display = 'none';
            }
        }

        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        // Form submission with loading state
        document.getElementById('checkoutForm').addEventListener('submit', function() {
            const submitBtn = document.querySelector('.checkout-btn');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
        });

        // Form validation enhancement
        const form = document.getElementById('checkoutForm');
        const inputs = form.querySelectorAll('input[required], textarea[required]');

        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>