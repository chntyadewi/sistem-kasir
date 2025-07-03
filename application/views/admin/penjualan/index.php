<!-- link -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!-- Font Awesome (update ke versi stabil & compatible) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    main.main-content {
    font-family: 'Poppins', sans-serif !important;
    }
    main.main-content i,
    main.main-content i::before {
    font-family: "Font Awesome 6 Free" !important;
    font-weight: 900; /* Solid */
    }
    :root {
            --color-terakota: #E07A5F;
            --color-terakota-dark: #B35B43;
            --color-terakota-light: #F4A261;
            --color-terakota-bg: #FFF2EB;
            --color-terakota-text: #6B4226;
            --color-terakota-gelap: #987456;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .breadcrumb-custom {
            background-color: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.95rem;
        }

        .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: var(--color-terakota-dark);
            padding: 0 5px;
        }

        .breadcrumb-custom a {
            text-decoration: none;
            color: inherit;
        }

       .table-bordered {
            border: 2px solid var(--color-terakota);
            border-radius: 2px;
            overflow: hidden;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid var(--color-terakota-light) !important;
            vertical-align: middle;
            padding: 12px 15px;
            color: var(--color-terakota-text) ;
        }

        .table-bordered th {
            background-color: var(--color-terakota) !important;
            color: #6B4226 !important;
        }

        .table-bordered thead {
            background-color: var(--color-terakota) !important;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table-bordered tbody tr:hover {
            background-color: var(--color-terakota-bg);
            cursor: pointer;
        }

        .table-bordered tbody tr td.text-center {
            font-style: bold;
            color: #999;
            
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-sm:hover {
            background-color: var(--color-terakota-dark);
            color: white !important;
        }

        .btn-danger {
            background-color: #D9534F;
            border-color: #D43F3A;
        }

        .btn-danger:hover {
            background-color: #B52B27;
            border-color: #8C1F1B;
        }

        .fas {
            font-size: 0.9rem;
        }

        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            border-radius: 6px;
            border: none;
            border-top: 4px solid var(--color-terakota);
        }

        .card-header {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .card-title {
            color: var(--color-terakota-dark);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .btn[style] {
            border-radius: 6px;
            font-weight: 500;
        } 

        .btn-primary {
            background-color: var(--color-terakota-dark) !important;
            border-color: var(--color-terakota-dark) !important;
            color: white !important;
            font-weight: 500 !important;
        }

        .btn-primary:hover {
            background-color: var(--color-terakota-dark) !important;
            border-color: var(--color-terakota-dark) !important;
            color: white !important;
        }
        #btn-cetak:hover {
            background-color: #EFD8C2;
            border-color: #B35B43;
            color: #6B4226;
        } 
</style>

<main class="main-content" style="padding: 80px 15px 15px; background-color: #f9f9f9; min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">RIWAYAT PENJUALAN</h4>
                    </div>
                    <div class="card-body">

                        <!-- Form Filter -->
                        <form method="get" action="<?= base_url('admin/penjualan') ?>" class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="tahun" class="form-control">
                                        <option value="">-- Pilih Tahun --</option>
                                        <?php for ($i = date('Y'); $i >= 2020; $i--): ?>
                                            <option value="<?= $i ?>" <?= ($this->input->get('tahun') == $i ? 'selected' : '') ?>>
                                                <?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="bulan" class="form-control">
                                        <option value="">-- Pilih Bulan --</option>
                                        <?php
                                        $bulan = [
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                        ];
                                        foreach ($bulan as $num => $nama):
                                        ?>
                                            <option value="<?= $num ?>" <?= ($this->input->get('bulan') == $num ? 'selected' : '') ?>>
                                                <?= $nama ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="minggu" class="form-control">
                                        <option value="">-- Pilih Minggu ke --</option>
                                        <?php for ($i = 1; $i <= 52; $i++): ?>
                                            <option value="<?= $i ?>" <?= ($this->input->get('minggu') == $i ? 'selected' : '') ?>>
                                                Minggu ke-<?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                <button type="submit"
                                    class="btn w-100"
                                    style="background-color: #F6E7D7; border: 1px solid #E07A5F; color: #6B4226; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                </div>
                            </div>
                        </form>

                        <!-- Tabel Riwayat Penjualan -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kasir</th>
                                        <th>Total</th>
                                        <th>Bayar</th>
                                        <th>Kembali</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sales as $key => $sale): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($sale->tanggal)) ?></td>
                                            <td><?= $sale->nama_kasir ?></td>
                                            <td>Rp <?= number_format($sale->total, 0, ',', '.') ?></td>
                                            <td>Rp <?= number_format($sale->bayar, 0, ',', '.') ?></td>
                                            <td>Rp <?= number_format($sale->kembali, 0, ',', '.') ?></td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-sm view-detail"
                                                    data-id="<?= $sale->id ?>"
                                                    style="background-color: #F6E7D7; border: 1px solid #E07A5F; color: #6B4226; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                                                    <i class="fa-solid fa-eye"></i> 
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($sales)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data penjualan</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-3">
                            <a href="<?= base_url('admin/penjualan/cetak?' . $_SERVER['QUERY_STRING']) ?>" target="_blank"
                                class="btn"
                                style="background-color: #F6E7D7; border: 1px solid #E07A5F; color: #6B4226; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                                <i class="fa-solid fa-print"></i> Cetak Laporan
                            </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal untuk menampilkan detail -->
<div class="modal fade" id="detailModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="detailContent">
                <!-- Konten dari view.php akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>

<!-- Script Detail Modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.view-detail').click(function() {
        var id = $(this).data('id');

        // Memuat konten view.php ke dalam modal
        $.ajax({
            url: '<?= site_url("admin/penjualan/view/") ?>' + id,
            type: 'GET',
            success: function(response) {
                $('#detailContent').html(response);
                $('#detailModal').modal({
                    backdrop: true,
                    keyboard: true
                });
                $('#detailModal').modal('show');
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan saat memuat detail penjualan');
            }
        });
    });

    // Menambahkan event listener untuk menutup modal saat mengklik di luar modal
    $(document).on('click', function(e) {
        if ($(e.target).hasClass('modal')) {
            $('#detailModal').modal('hide');
        }
    });
});
</script>