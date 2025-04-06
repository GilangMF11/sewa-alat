<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Struk | <?= esc($rental['transaction_code']) ?></title>
    <link rel="icon" href="<?= base_url('uploads/logo/' . $setting['logo']) ?>" type="image/png">

    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            width: 58mm; /* Thermal Printer 58mm */
            margin: 0;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="text-center">
        <h4><?= esc($setting['name_web']) ?></h4>
        <p>Jln Soeprapto No. 12 Gang IV<br>+<?= esc($setting['phone']) ?></p>
    </div>

    <hr>

    <table>
        <tr>
            <td>ID:</td>
            <td class="text-right"><?= esc($rental['transaction_code']) ?></td>
        </tr>
        <tr>
            <td>Nama:</td>
            <td class="text-right"><?= esc($rental['customer_name']) ?></td>
        </tr>
        <tr>
            <td>Tanggal:</td>
            <td class="text-right"><?= date('d-m-Y', strtotime($rental['created_at'])) ?></td>
        </tr>
    </table>

    <hr>

    <table>
        <?php foreach ($items as $item): ?>
            <tr>
                <td colspan="2"><?= esc($item['item_name']) ?></td>
            </tr>
            <tr>
                <td><?= esc($item['quantity']) ?> x Rp. <?= number_format($item['price'], 0, ',', '.') ?></td>
                <td class="text-right">Rp. <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr>
    <table>
        <tr>
            <td>DP</td>
            <td class="text-right"><?= esc($rental['down_payment']) ?></td>
        </tr>
        <tr>
            <td>Ongkir</td>
            <td class="text-right"><?= esc($rental['shipping_cost']) ?></td>
        </tr>
        <tr>
            <td>Diskon</td>
            <td class="text-right"><?= esc($rental['discount']) ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td class="text-right">
            <?php if ($rental['payment_status'] == 1): ?>
                                    <span class="badge badge-success">Lunas</span>
                                    <?php else: ?>
                                    <span class="badge badge-warning">Belum Lunas</span>
                                    <?php endif; ?>
            </td>
        </tr>
    </table>

    <hr>

    <table>
        <tr>
            <td>Total</td>
            <td class="text-right">Rp. <?= number_format($rental['total_price'], 0, ',', '.') ?></td>
        </tr>
    </table>

    <div class="text-center">
        <p>Terima Kasih!</p>
    </div>
</body>
</html>
