<!-- Main Content -->
<main class="main-content" style="padding: 85px 20px 20px; background-color: #f9f9f9; min-height: 100vh;">
    <div class="container-fluid">
    <div class="container px-4" style="max-width: 1100px;">
        <style>
            .breadcrumb-custom {
                background-color: transparent;
                padding: 0;
                margin: 0;
                font-size: 0.95rem;
            }

            .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
                content: "›";
                color: #7B3F00;
                padding: 0 5px;
            }

            .dashboard-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
            }

            .dashboard-header h1 {
                margin: 0;
                color: #7B3F00;
                font-weight: 700;
            }

            .card:hover {
                transform: translateY(-4px);
                transition: all 0.3s ease;
                box-shadow: 0 12px 24px rgba(0,0,0,0.2) !important;
            }

            .animated-fade {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeInUp 0.8s forwards;
            }

            .animated-fade:nth-child(1) { animation-delay: 0.1s; }
            .animated-fade:nth-child(2) { animation-delay: 0.2s; }
            .animated-fade:nth-child(3) { animation-delay: 0.3s; }

            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .welcome-banner {
                background: linear-gradient(135deg, #FFD4B2, #FFB085);
                padding: 15px 25px;
                border-radius: 16px;
                color: #7B3F00;
                font-weight: bold;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                margin-bottom: 5px;
            }

            .welcome-banner i {
                font-size: 28px;
                margin-right: 10px;
                color: #BB5A27;
            }

            .swal2-toast .swal2-title {
                color: white;
            }
                
            .swal2-toast.swal2-success {
                    background-color: #B24F36  !important; 
            }
        </style>
    
        <!-- Header with breadcrumb -->
        <div class="dashboard-header">
            <h1 class="h1">Beranda</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom mb-0">
                    <li class="breadcrumb-item active"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Beranda</li>
                </ol>
            </nav>
        </div>

        <!-- Welcome Banner -->
        <div class="welcome-banner mb-4">
            <i class="fas fa-seedling"></i>
            <div>Selamat datang kembali di <strong>Agro Kebun Salak Sibetan</strong>! Semoga hasil panen dan bisnis Anda selalu sukses dan berkah.</div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4 animated-fade">
                <div class="card shadow h-100 py-3" style="background: linear-gradient(135deg, #E07A5F 80%, #C25E45 100%); color: white; border-radius: 12px; box-shadow: 0 8px 20px #E07A5F;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-2">Total Produk</div>
                                <div class="h4 font-weight-bold"><?php echo $total_produk; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4 animated-fade">
                <div class="card shadow h-100 py-3" style="background: linear-gradient(135deg, #E07A5F 80%, #A54838 100%); color: white; border-radius: 12px; box-shadow: 0 8px 20px #E07A5F;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-2">Total Jenis Produk</div>
                                <div class="h4 font-weight-bold"><?php echo $total_kategori; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4 animated-fade">
                <div class="card shadow h-100 py-3" style="background: linear-gradient(135deg, #E07A5F 80%, #8F3E2F 100%); color: white; border-radius: 12px; box-shadow: 0 8px 20px #E07A5F;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-2">Total Penjualan</div>
                                <div class="h4 font-weight-bold"><?php echo $total_penjualan; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optional Card: Total Pengguna -->
            <!--
            <div class="col-xl-4 col-md-6 mb-4 animated-fade">
                <div class="card shadow h-100 py-3" style="background: linear-gradient(135deg, #9C4B1A 80%, #653218 100%); color: white; border-radius: 12px; box-shadow: 0 8px 20px #9C4B1A;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-2">Total Pengguna</div>
                                <div class="h4 font-weight-bold"><?php echo $total_pengguna; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
            
        </div>
        <div class="container mt-4">
  <div class="card shadow rounded-4 border-0" style="background-color: #fff;">
    <div class="card-body">
      <h5 class="mb-4 fw-semibold" style="color: #8F3E2F;">
        <i class="fas fa-boxes me-2"></i>Stok Hampir Habis
      </h5>
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle" style="border-color: #e0d5d0;">
          <thead style="background: linear-gradient(135deg, #E07A5F, #8F3E2F); color: white;">
            <tr>
              <th style="border-color: #d6bfb5;">Nama Produk</th>
              <th style="border-color: #d6bfb5;">Stok</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($low_stock_products as $produk): ?>
            <tr>
              <td style="border-color: #f0e7e2;"><?= htmlspecialchars($produk->nama_produk) ?></td>
              <td style="border-color: #f0e7e2;">
                <span class="badge rounded-pill bg-danger px-3 py-2">
                  <?= (int)$produk->stok ?>
                </span>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

    </div>
    <?php if ($this->session->flashdata('welcome')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Berhasil masuk, Selamat Datang Admin!',
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal2-success'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        });
    </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

