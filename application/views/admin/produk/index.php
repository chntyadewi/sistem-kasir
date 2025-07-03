<main class="main-content" style="padding: 80px 15px 15px; background-color: #f9f9f9; min-height: 100vh;">
    <div class="container-fluid">
        <!-- STYLE -->
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
    </style>

        <!--BREADCRUMB -->
        <div class="dashboard-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>

        <!-- ===== CONTENT ===== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">DAFTAR PRODUK</h4>
                    <div class="d-flex gap-2">
                        <a href="<?= site_url('admin/produk/arsip') ?>" 
                            class="btn"
                            style="background-color: #E0E0E0; border: 1px solid #B0B0B0; color: #4A4A4A; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                            <i class="fas fa-archive" style="margin-right: 4px;"></i> Arsip
                        </a>
                        <button class="btn" data-bs-toggle="modal" data-bs-target="#createModal"
                            style="background-color: #B35B43; color:white;">
                            <i class="fas fa-plus" style="margin-right: 4px;"></i> Tambah Produk
                        </button>
                    </div>
                </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="produkTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Jenis Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $index => $product): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><img src="<?= base_url('./uploads/produk/' . $product->gambar); ?>"
                                                     style="width: 50px; height: 50px; object-fit: cover;"></td>
                                            <td><?= $product->nama_produk; ?></td>
                                            <td><?= $product->nama_kategori; ?></td>
                                            <td>Rp <?= number_format($product->harga, 0, ',', '.'); ?></td>
                                            <td><?= $product->stok; ?></td>
                                            <td>
                                                <button 
                                                    class="btn btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?= $product->id; ?>"
                                                    style="background-color: #FAD4C0; border: 1px solid #E07A5F; color: #6B4226; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                                                    <i class="fas fa-edit" style="color: #6B4226;"></i>
                                                </button>
                                                <a href="<?php echo site_url('admin/produk/delete/' . $product->id); ?>" 
                                                    class="btn btn-sm"
                                                    style="background-color: #F8C8C8; border: 1px solid #D9534F; color: #6B0000; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                                                    <i class="fas fa-ban" style="color: #6B0000;"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal<?php echo $product->id; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Produk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo site_url('admin/produk/edit/' . $product->id); ?>" method="post" enctype="multipart/form-data">
                                                            <div class="mb-3">
                                                                <label for="gambar<?php echo $product->id; ?>" class="form-label">Gambar Produk</label>
                                                                <input type="file" class="form-control" id="gambar<?php echo $product->id; ?>" name="gambar">
                                                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="nama_produk<?php echo $product->id; ?>" class="form-label">Nama Produk</label>
                                                                <input type="text" class="form-control"
                                                                    id="nama_produk<?php echo $product->id; ?>"
                                                                    name="nama_produk" required
                                                                    value="<?php echo $product->nama_produk; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kategori_id<?php echo $product->id; ?>" class="form-label">Jenis Produk</label>
                                                                <select class="form-select" id="kategori_id<?php echo $product->id; ?>" name="kategori_id" required>
                                                                    <option value="">Pilih Jenis Produk</option>
                                                                    <?php foreach ($categories as $category): ?>
                                                                        <option value="<?php echo $category->id; ?>"
                                                                            <?php echo set_select('kategori_id', $category->id, ($product->kategori_id == $category->id)); ?>>
                                                                            <?php echo $category->nama_kategori; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="harga<?php echo $product->id; ?>" class="form-label">Harga</label>
                                                                <input type="number" class="form-control"
                                                                    id="harga<?php echo $product->id; ?>"
                                                                    name="harga" required
                                                                    value="<?php echo $product->harga; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="stok<?php echo $product->id; ?>" class="form-label">Stok</label>
                                                                <input type="number" class="form-control"
                                                                    id="stok<?php echo $product->id; ?>"
                                                                    name="stok" required
                                                                    value="<?php echo $product->stok; ?>">
                                                            </div>
                                                            <div class="text-end">
                                                                <button type="button"
                                                                    class="btn"
                                                                    data-bs-dismiss="modal"
                                                                    style="background-color: #D9534F; color:white;">
                                                                    Batal
                                                                </button>

                                                                <button type="submit"
                                                                    class="btn"
                                                                    style="background-color: #B35B43; color:white;">
                                                                    <i class="fas fa-save" style="color: #ffffff !important;"></i> Simpan perubahan
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo site_url('admin/produk/create'); ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Jenis Produk</label>
                            <select class="form-select" id="kategori_id" name="kategori_id" required>
                                <option value="">Pilih Jenis Produk</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>"
                                        <?php echo set_select('kategori_id', $category->id); ?>>
                                        <?php echo $category->nama_kategori; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('kategori_id', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="text-end">
                            <button type="button"
                                class="btn"
                                data-bs-dismiss="modal"
                                style="background-color: #D9534F; color:white;">
                                Batal
                            </button>

                            <button type="submit"
                                class="btn"
                                style="background-color: #B35B43; color:white;">
                                <i class="fas fa-save" style="color: #ffffff !important;margin-right: 4px; "></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- SCRIPT DataTables -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
       
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function () {
                $('#produkTable').DataTable({
                    responsive: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                    }
                });
            });

            $(document).ready(function() {
                // SweetAlert konfirmasi hapus
                $('.btn-delete').on('click', function(e) {
                    e.preventDefault();
                    const href = $(this).attr('href');

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data produk akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = href;
                        }
                    });
                });

                // SweetAlert notifikasi success dari session flashdata (hapus atau update)
                <?php if($this->session->flashdata('success')): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '<?= $this->session->flashdata('success'); ?>',
                        timer: 1000,
                        showConfirmButton: false
                    });
                <?php endif; ?>
            });
        </script>
    </div>
</main>


