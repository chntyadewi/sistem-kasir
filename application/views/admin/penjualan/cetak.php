<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 30px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
            color: #E07A5F;
            margin-top: 40px;
        }

        .header p {
            margin: 4px 0 0;
            font-size: 14px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f5f5f5;
            color: #222;
            font-weight: 500;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-box {
            margin-top: 20px;
            width: 100%;
        }

        .total-label {
            text-align: right;
            font-weight: 600;
        }

        .total-value {
            font-weight: bold;
            color: #000;
        }

        .total-box {
            text-align: right;
            margin-top: 25px;
            font-weight: 600;
            font-size: 16px;
        }

        .total-label {
            margin-right: 10px;
        }

        .total-value {
            color: #000;
        }


        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <?php
        // Ambil parameter filter (jika ada)
        $tahun  = $this->input->get('tahun');
        $bulan  = $this->input->get('bulan');
        $minggu = $this->input->get('minggu');

        // Buat label tanggal laporan
        $label = '';
        if ($tahun) $label .= "Tahun $tahun ";
        if ($bulan) {
            $bulan_nama = [
                1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni',
                7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
            ];
            $label .= "Bulan " . $bulan_nama[(int)$bulan] . " ";
        }
        if ($minggu) $label .= "Minggu ke-$minggu";
        if ($label == '') $label = date('d F Y'); // fallback jika tidak ada filter
    ?>

    <div class="header">
        <h1>Laporan Penjualan</h1>
        <p><?= $label ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembali</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $grand_total = 0;
            foreach ($sales as $key => $sale):
                $grand_total += $sale->total;
            ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= date('d/m/Y H:i', strtotime($sale->tanggal)) ?></td>
                <td><?= $sale->nama_kasir ?></td>
                <td>Rp <?= number_format($sale->total, 0, ',', '.') ?></td>
                <td>Rp <?= number_format($sale->bayar, 0, ',', '.') ?></td>
                <td>Rp <?= number_format($sale->kembali, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($sales)): ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data penjualan</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Total Penjualan -->
    <?php if (!empty($sales)): ?>
    <div class="total-box">
        <span class="total-label">Total Penjualan:</span>
        <span class="total-value">Rp <?= number_format($grand_total, 0, ',', '.') ?></span>
    </div>
<?php endif; ?>


</body>
</html>
