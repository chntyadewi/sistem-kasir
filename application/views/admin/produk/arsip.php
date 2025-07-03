<main class="main-content" style="padding: 80px 15px 15px; background-color: #f9f9f9; min-height: 100vh;">
<div class="container-fluid">
<style>
        :root {
            --color-terakota: #E07A5F;
            --color-terakota-dark: #B35B43;
            --color-terakota-light: #F4A261;
            --color-terakota-bg: #FFF2EB;
            --color-terakota-text: #6B4226;
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

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
        display: flex;
        align-items: center;
        }

        .dataTables_wrapper .dataTables_length label {
        gap: 0.5rem;
        }
        
        .dataTables_wrapper .dataTables_length {
        float: left;
        }

        .dataTables_wrapper .dataTables_filter {
        float: right;
        }

        .dataTables_wrapper .dataTables_length {
        margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5rem;
        padding: 4px 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        }
        .btn-aktifkan:hover {
        background-color: #95D5B2 !important;
        color: #1B4332 !important;
    }
    </style>

<!-- Breadcrumb -->
<div class="dashboard-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom mb-0">
            <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('admin/produk') ?>">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Status Produk</li>
        </ol>
    </nav>
</div>

<!-- Card -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">DAFTAR PRODUK NONAKTIF</h4>
        <a href="<?= site_url('admin/produk') ?>" class="btn" style="background-color: #B35B43; color:white;">
            <i class="fas fa-arrow-left" style="margin-right: 4px;"></i> Kembali 
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="produkNonaktifTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $key => $product): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><img src="<?= base_url('./uploads/produk/' . $product->gambar); ?>"
                            style="width: 50px; height: 50px; object-fit: cover;"></td>
                        <td><?= $product->nama_produk ?></td>
                        <td>Rp<?= number_format($product->harga, 0, ',', '.') ?></td>
                        <td><?= $product->stok ?></td>
                        <td>
                            <a href="<?= site_url('admin/produk/restore/' . $product->id) ?>"
                                class="btn btn-sm btn-aktifkan"
                                style="background-color: #D8F3DC; border: 1px solid #2D6A4F; color: #1B4332; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                                <i class="fas fa-undo" style="margin-right: 4px;"></i> Aktifkan
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables Script -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#produkNonaktifTable').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
</script>

</div>
</main>
