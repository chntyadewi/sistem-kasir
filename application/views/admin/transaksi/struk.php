<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mb-1 { margin-bottom: 10px; }
        .divider { border-top: 1px dashed #000; margin: 10px 0; }
        table { width: 100%; }
        th, td { padding: 3px 0; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
<div class="text-center mb-1">
        <h3 style="margin:0;">Salak Tani</h3>
        <p style="margin:0;">Jl. Baledan, Sibetan, Kec. Bebandem, Kabupaten Karangasem, Bali 80861</p>
        <p style="margin:0;">Telp: +62361222387</p>
    </div>

    <div class="mb-1">
        <table>
            <tr>
                <td>Tanggal</td>
                <td>: <?php echo date('d/m/Y H:i', strtotime($sale->tanggal)); ?></td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: <?php echo $sale->nama_kasir; ?></td>
            </tr>
            <tr>
                <td>NO</td>
                <td>: <?php echo $sale->no_invoice; ?></td>
            </tr>
        </table>
    </div>

    <div class="divider"></div>

    <table>
        <?php foreach($items as $item): ?>
        <tr>
            <td colspan="3"><?php echo $item->nama_produk; ?></td>
        </tr>
        <tr>
            <td><?php echo $item->kuantitas; ?> x</td>
            <td>Rp <?php echo number_format($item->harga, 0, ',', '.'); ?></td>
            <td class="text-right">Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="divider"></div>

    <table>
        <tr>
            <td>Total</td>
            <td class="text-right">Rp <?php echo number_format($sale->total, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="text-right">Rp <?php echo number_format($sale->bayar, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="text-right">Rp <?php echo number_format($sale->kembali, 0, ',', '.'); ?></td>
        </tr>
    </table>

    <div class="divider"></div>

    <div class="text-center">
        Terima kasih atas kunjungan Anda
    </div>

    <div class="text-center no-print" style="margin-top: 20px;">
        <button onclick="window.print()">Print Struk</button>
        <a href="<?php echo site_url('admin/transaksi'); ?>">
            <button type="button">Kembali</button>
        </a>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html> 
