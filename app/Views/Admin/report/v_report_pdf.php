<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Sewa</title>
    <link rel="icon" href="<?= base_url('uploads/logo/' . $setting['logo']) ?>" type="image/png">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 10px;
        }
        .title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .sub-title {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        table, th, td {
            border: 1px dashed #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
            font-size: 9pt;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 9pt;
        }
    </style>
</head>
<body>

<div class="title">LAPORAN TRANSAKSI SEWA BARANG</div>
<div class="sub-title"><?= date('d-m-Y') ?></div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Penyewa</th>
            <th>Tgl Sewa</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($rentals as $rental): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($rental['transaction_code']) ?></td>
            <td><?= esc($rental['customer_name']) ?></td>
            <td><?= esc(date('d-m-Y', strtotime($rental['created_at']))) ?></td>
            <td>
                <?php if ($rental['return_status'] == 1): ?>
                    Kembali
                <?php else: ?>
                    Belum
                <?php endif; ?>
            </td>
            <td>Rp. <?= number_format($rental['total_price'], 0, ',', '.') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="footer">
    Dicetak pada: <?= date('d-m-Y H:i:s') ?>
</div>

</body>
</html>


