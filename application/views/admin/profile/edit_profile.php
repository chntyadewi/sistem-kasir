<!-- Google Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
  body, h1, h2, h3, h4, h5, h6, p, label, input, select, textarea, button, .form-control {
    font-family: 'Poppins', sans-serif !important;
  }

  label {
    font-weight: 600; 
    color: #333;       
  }
</style>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<main class="main-content" style="padding: 80px 15px 15px; background-color: #f9f9f9; min-height: 100vh;">
  <div class="container-fluid">
    <div class="container mt-4">
      <div class="card shadow-sm rounded-3" style="border-top: 4px solid #E07A5F; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);">
        <div class="card-body">
          <h4 class="mb-4 text-uppercase" style="color: #B35B43; font-weight: 700; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
            Pengaturan Profil
          </h4>

          <!-- SweetAlert Flash Messages -->
          <?php if ($this->session->flashdata('error')): ?>
            <script>
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= addslashes($this->session->flashdata('error')) ?>',
                confirmButtonColor: '#E07A5F',
              });
            </script>
          <?php elseif ($this->session->flashdata('success')): ?>
            <script>
              Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= addslashes($this->session->flashdata('success')) ?>',
                confirmButtonColor: '#E07A5F',
              });
            </script>
          <?php endif; ?>

          <form method="post" action="<?= base_url('admin/profile/update') ?>" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-3 text-center mb-3">
                <img 
                  src="<?= base_url('uploads/profile/admin/' . (!empty($user->gambar) ? $user->gambar : 'pic.jpg')) ?>" 
                  width="178" 
                  height="178" 
                  style="border-radius: 50%; object-fit: cover;" 
                  alt="Foto Profil">

                <div class="mt-2">
                  <input type="file" name="gambar" class="form-control form-control-sm" accept="image/*">
                </div>
              </div>

              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label>ID Pengguna</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($user->id) ?>" disabled>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Peran</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($user->role) ?>" disabled>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Nama Pengguna</label>
                    <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($user->nama) ?>" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Password Saat Ini</label>
                    <input type="password" class="form-control" name="current_password" placeholder="Password saat ini">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Password baru">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi password">
                  </div>
                </div>
              </div>
            </div>

            <div class="text-end">
              <button class="btn mt-3 px-4" type="submit" style="background-color:#E07A5F; border-color:#E07A5F; color: white; font-weight: 500; border-radius: 6px;">
                <i class="fas fa-save"></i> Simpan
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</main>
