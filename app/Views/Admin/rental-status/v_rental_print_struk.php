<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Struk | <?= esc($rental['transaction_code']) ?></title>
    <link rel="icon" href="<?= base_url('uploads/logo/' . ($setting['logo'] ?? 'default-logo.png')) ?>" type="image/png">
    
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        
        body {
            font-family: 'Courier New', monospace;
            font-size: 11px;
            line-height: 1.2;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        
        .receipt-container {
            width: 70mm; /* Lebar struk thermal */
            background-color: white;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 0 auto;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-left {
            text-align: left;
        }
        
        .header {
            border-bottom: 1px dashed #333;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }
        
        .header h3 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }
        
        .header p {
            margin: 2px 0;
            font-size: 10px;
        }
        
        .section {
            border-bottom: 1px dashed #333;
            padding: 5px 0;
            margin: 5px 0;
        }
        
        .customer-info table,
        .items-table,
        .summary-table,
        .total-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .customer-info td {
            padding: 1px 0;
            font-size: 10px;
        }
        
        .items-table td {
            padding: 2px 0;
            font-size: 10px;
        }
        
        .item-name {
            font-weight: bold;
        }
        
        .item-detail {
            color: #666;
        }
        
        .summary-table td,
        .total-table td {
            padding: 2px 0;
            font-size: 10px;
        }
        
        .total-table {
            border-top: 2px solid #333;
            margin-top: 5px;
        }
        
        .total-table td {
            font-weight: bold;
            font-size: 12px;
        }
        
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
        }
        
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .qr-code {
            margin: 10px 0;
        }
        
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            
            .receipt-container {
                box-shadow: none;
                border: none;
                border-radius: 0;
            }
        }
        
        /* Dotted lines untuk pemisah */
        .dotted-line {
            border-bottom: 1px dotted #333;
            margin: 5px 0;
            height: 1px;
        }
        
        .solid-line {
            border-bottom: 1px solid #333;
            margin: 5px 0;
            height: 1px;
        }
        
        .double-line {
            border-bottom: 3px double #333;
            margin: 5px 0;
            height: 2px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt-container">
        <!-- Header -->
        <div class="header text-center">
            <h3><?= esc($setting['name_web'] ?? 'Ngesti Gongso Kemojing') ?></h3>
            <p>Telp: +<?= esc($setting['phone'] ?? '081234567892') ?></p>
        </div>

        <!-- Customer Info -->
        <div class="section">
            <table class="customer-info">
                <tr>
                    <td width="35%">No. Transaksi</td>
                    <td width="5%">:</td>
                    <td class="text-right"><?= esc($rental['transaction_code']) ?></td>
                </tr>
                <tr>
                    <td>Nama Customer</td>
                    <td>:</td>
                    <td class="text-right"><?= esc($rental['customer_name']) ?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td class="text-right"><?= date('d/m/Y H:i', strtotime($rental['created_at'])) ?></td>
                </tr>
                <?php if (!empty($rental['address'])): ?>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td class="text-right"><?= esc(substr($rental['address'], 0, 25)) ?><?= strlen($rental['address']) > 25 ? '...' : '' ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>

        <!-- Items -->
        <div class="section">
            <table class="items-table">
                <tr>
                    <td colspan="2" class="text-center" style="font-weight: bold; border-bottom: 1px solid #333; padding-bottom: 3px;">DETAIL SEWA</td>
                </tr>
                <?php 
                $subtotal = 0;
                foreach ($items as $item): 
                    $itemTotal = $item['price'] * $item['quantity'];
                    $subtotal += $itemTotal;
                ?>
                    <tr>
                        <td colspan="2" class="item-name"><?= esc($item['item_name']) ?></td>
                    </tr>
                    <tr>
                        <td class="item-detail">
                            <?= esc($item['quantity']) ?> x Rp <?= number_format($item['price'], 0, ',', '.') ?>
                            <?php if (isset($item['borrow_date']) && isset($item['return_date'])): ?>
                            <br>
                            <small>
                                <?= date('d/m/Y', strtotime($item['borrow_date'])) ?> - 
                                <?= date('d/m/Y', strtotime($item['return_date'])) ?>
                            </small>
                            <?php endif; ?>
                        </td>
                        <td class="text-right">Rp <?= number_format($itemTotal, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="dotted-line"></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Summary -->
        <div class="section">
            <table class="summary-table">
                <tr>
                    <td width="60%">Subtotal</td>
                    <td class="text-right">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                </tr>
                
                <?php if (isset($rental['shipping_cost']) && $rental['shipping_cost'] > 0): ?>
                <tr>
                    <td>Ongkos Kirim</td>
                    <td class="text-right">Rp <?= number_format($rental['shipping_cost'], 0, ',', '.') ?></td>
                </tr>
                <?php endif; ?>
                
                <?php if (isset($rental['discount']) && $rental['discount'] > 0): ?>
                <tr>
                    <td>Diskon</td>
                    <td class="text-right">-Rp <?= number_format($rental['discount'], 0, ',', '.') ?></td>
                </tr>
                <?php endif; ?>
                
                <?php if (isset($rental['down_payment']) && $rental['down_payment'] > 0): ?>
                <tr>
                    <td>DP/Uang Muka</td>
                    <td class="text-right">Rp <?= number_format($rental['down_payment'], 0, ',', '.') ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>

        <!-- Total -->
        <table class="total-table">
            <tr>
                <td width="60%">TOTAL BAYAR</td>
                <td class="text-right">Rp <?= number_format($rental['total_price'], 0, ',', '.') ?></td>
            </tr>
        </table>

        <!-- Status -->
        <div class="section">
            <table style="width: 100%;">
                <tr>
                    <td width="50%">Status Pembayaran:</td>
                    <td class="text-right">
                        <?php if ($rental['payment_status'] == 1): ?>
                            <span class="badge badge-success">LUNAS</span>
                        <?php else: ?>
                            <span class="badge badge-warning">BELUM LUNAS</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Status Pengembalian:</td>
                    <td class="text-right">
                        <?php if ($rental['return_status'] == 1): ?>
                            <span class="badge badge-success">SUDAH KEMBALI</span>
                        <?php else: ?>
                            <span class="badge badge-danger">BELUM KEMBALI</span>
                        <?php endif; ?>
                    </td>
                </tr>
                
                <?php 
                // Determine payment method
                $paymentMethod = '';
                if (isset($rental['payment_type'])) {
                    switch($rental['payment_type']) {
                        case 0: $paymentMethod = 'TUNAI'; break;
                        case 1: $paymentMethod = 'TRANSFER'; break;
                        case 2: $paymentMethod = 'KREDIT'; break;
                        case 3: $paymentMethod = 'E-WALLET'; break;
                        default: $paymentMethod = 'LAINNYA';
                    }
                }
                ?>
                <?php if (!empty($paymentMethod)): ?>
                <tr>
                    <td>Metode Pembayaran:</td>
                    <td class="text-right"><?= $paymentMethod ?></td>
                </tr>
                <?php endif; ?>
                
                <?php if (isset($rental['payment_due']) && $rental['payment_due'] && $rental['payment_due'] != '0000-00-00'): ?>
                <tr>
                    <td>Jatuh Tempo:</td>
                    <td class="text-right"><?= date('d/m/Y', strtotime($rental['payment_due'])) ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="double-line"></div>
            <p><strong>TERIMA KASIH!</strong></p>
            <p>Barang yang sudah disewa<br>tidak dapat dikembalikan</p>
            <p style="margin-top: 8px;">
                <small>Dicetak: <?= date('d/m/Y H:i:s') ?></small>
            </p>
            
            
        </div>
    </div>
</body>
</html>