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
            <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
            </ol>
        </nav>
        </div>

        <!-- ===== CONTENT ===== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">DAFTAR PENGGUNA</h4>
                        <button class="btn" data-bs-toggle="modal" data-bs-target="#createUserModal"
                            style="background-color: #B35B43; color:white;">
                            <i class="fas fa-plus"></i> Tambah Pengguna
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="penggunaTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Gambar</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $key => $user): ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $user->nama; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td>
                                            <?php if (!empty($user->gambar)): ?>
                                                <?php
                                                $filename = !empty($user->gambar) ? $user->gambar : 'pic.jpg';
                                                $paths = [
                                                    'admin' => FCPATH . 'uploads/profile/admin/' . $filename,
                                                    'kasir' => FCPATH . 'uploads/profile/kasir/' . $filename
                                                ];

                                                $role_folder = 'admin'; // default
                                                foreach ($paths as $folder => $path) {
                                                    if (file_exists($path)) {
                                                        $role_folder = $folder;
                                                        break;
                                                    }
                                                }

                                                $img_url = base_url('uploads/profile/' . $role_folder . '/' . $filename);
                                                ?>
                                                <img src="<?= $img_url ?>" width="40" height="40" class="rounded-circle" style="object-fit: cover;">
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo $user->role == 'admin' ? 'primary' : 'success'; ?>">
                                                <?php echo ucfirst($user->role); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editUserModal<?php echo $user->id; ?>"
                                                style="background-color: #FAD4C0; border: 1px solid #E07A5F; color: #6B4226; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                                                <i class="fas fa-edit" style="color: #6B4226;"></i>
                                            </button>
                                            <?php if($user->id != $this->session->userdata('user_id')): ?>
                                                <a href="<?php echo site_url('admin/pengguna/delete/'.$user->id); ?>"
                                                    class="btn btn-sm"
                                                    style="background-color: #F8C8C8; border: 1px solid #D9534F; color: #6B0000; font-weight: 500; border-radius: 6px; transition: 0.3s;">
                                                    <i class="fas fa-trash" style="color: #6B0000;"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <?php foreach($users as $user): ?>
                                <div class="modal fade" id="editUserModal<?php echo $user->id; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ubah Data Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="<?= site_url('admin/pengguna/edit/' . $user->id); ?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Foto Profil</label><br>
                                                <?php if ($user->gambar): ?>
                                                    <img src="<?= base_url('uploads/profile/' . ($user->role == 'admin' ? 'admin' : 'kasir') . '/' . (!empty($user->gambar) ? $user->gambar : 'pic.jpg')); ?>"
                                                        width="40" height="40" 
                                                        class="rounded-circle mb-2" 
                                                        style="object-fit: cover;">
                                                <?php endif; ?>
                                                <input type="file" class="form-control" name="gambar">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" value="<?= $user->nama; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="<?= $user->email; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Role</label>
                                                <select class="form-select" name="role" required>
                                                    <option value="admin" <?= $user->role == 'admin' ? 'selected' : '' ?>>Admin</option>
                                                    <option value="pengguna" <?= $user->role == 'pengguna' ? 'selected' : '' ?>>Pengguna</option>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
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
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div> <!-- end card-body -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="createUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= site_url('admin/pengguna/create') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Foto Profil</label>
                    <input type="file" class="form-control" name="gambar">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="kata_sandi" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="pengguna">Pengguna</option>
                    </select>
                </div>
                </div>
                <div class="modal-footer">
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
                $('#penggunaTable').DataTable({
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


