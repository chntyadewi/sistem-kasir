<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Detail Penjualan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td width="30%">Tanggal</td>
                                <td>: <?php echo date('d/m/Y H:i', strtotime($sale->tanggal)); ?></td>
                            </tr>
                            <tr>
                                <td>Kasir</td>
                                <td>: <?php echo $sale->nama_kasir; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td width="30%">Total</td>
                                <td>: Rp <?php echo number_format($sale->total, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td>Bayar</td>
                                <td>: Rp <?php echo number_format($sale->bayar, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td>Kembali</td>
                                <td>: Rp <?php echo number_format($sale->kembali, 0, ',', '.'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $key => $item): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $item->nama_produk; ?></td>
                                <td>Rp <?php echo number_format($item->harga, 0, ',', '.'); ?></td>
                                <td><?php echo $item->kuantitas; ?></td>
                                <td>Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total</th>
                                <th>Rp <?php echo number_format($sale->total, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button onclick="printDiv('printArea')" class="btn"style="background-color: #987456; color:white;">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    $(document).on('click', function(e) {
        if ($(e.target).hasClass('modal')) {
            $('#detailModal').modal('hide');
        }
    });
}
</script>

<div id="printArea" style="display:none;">
    <div style="padding: 20px;">
        <div class="text-center mb-1">
        <h3 style="margin:0;">SalakTani</h3>
        <p style="margin:0;">Jl. Baledan, Sibetan, Kec. Bebandem, Kabupaten Karangasem, Bali 80861</p>
        <p style="margin:0;">Telp: +62361222387</p>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-sm">
                    <tr>
                        <td width="30%">Tanggal</td>
                        <td>: <?php echo date('d/m/Y H:i', strtotime($sale->tanggal)); ?></td>
                    </tr>
                    <tr>
                        <td>Kasir</td>
                        <td>: <?php echo $sale->nama_kasir; ?></td>
                    </tr>
                </table>
            </div>
            <table class="table table-bordered"> 
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $key => $item): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $item->nama_produk; ?></td>
                    <td>Rp <?php echo number_format($item->harga, 0, ',', '.'); ?></td>
                    <td><?php echo $item->kuantitas; ?></td>
                    <td>Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total</th>
                    <th>Rp <?php echo number_format($sale->total, 0, ',', '.'); ?></th>
                </tr>
            </tfoot>
        </table>
            <div class="col-md-6">
                <table class="table table-sm">
                    <tr>
                        <td width="30%">Total</td>
                        <td>: Rp <?php echo number_format($sale->total, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>Bayar</td>
                        <td>: Rp <?php echo number_format($sale->bayar, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td>Kembali</td>
                        <td>: Rp <?php echo number_format($sale->kembali, 0, ',', '.'); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
