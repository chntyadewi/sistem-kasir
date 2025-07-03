<main class="main-content" style="padding: 85px 20px 20px; background-color: #f9f9f9; min-height: 100vh;">
    <div class="container-fluid">
    <!-- Stat Cards -->
    <div class="row mb-4" style="margin-top: 10px;"> 
      <!-- Transaksi Hari Ini -->
      <div class="col-lg-6 mb-4">
        <div class="card shadow rounded-4 border-0">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div class="text-muted text-uppercase small fw-semibold mb-1" style="color: #987456;">
                Transaksi Hari Ini
              </div>
              <div class="display-6 fw-bold">
                <?php echo $transaksi_hari_ini; ?>
              </div>
            </div>
            <div>
              <i class="fas fa-shopping-cart fa-2x text-secondary"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Penjualan Hari Ini -->
      <div class="col-lg-6 mb-4">
        <div class="card shadow rounded-4 border-0">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <div class="text-muted text-uppercase small fw-semibold mb-1" style="color: #987456;">
                Total Penjualan Hari Ini
              </div>
              <div class="display-6 fw-bold">
                Rp <?php echo number_format($total_penjualan_hari_ini ?? 0, 0, ',', '.'); ?>
              </div>
            </div>
            <div>
              <i class="fas fa-dollar-sign fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Action -->
    <div class="row" style="margin-top: -50px;"> <!-- Sebelumnya mt-4, sekarang jadi mt-2 -->
  <div class="col-12">
    <div class="card border-0 shadow rounded-4 bg-white">
      <div class="card-body py-5 px-4 d-flex flex-column align-items-center text-center">
        
        <!-- Icon -->
        <div class="mb-2">
          <i class="fas fa-store fa-3x mb-3" style="color: #E07A5F;"></i>
        </div>

        <!-- Title -->
        <h4 class="fw-bold mb-2" style="color: #987456;">Yuk, Mulai Transaksi Hari Ini!</h4>

        <!-- Subtitle -->
        <p class="text-muted mb-3" style="max-width: 600px;">
          Mencatat penjualan pertama adalah langkah awal menuju hari yang produktif.
        </p>

        <!-- Highlight Line -->
        <div style="width: 60px; height: 4px; background: #E07A5F; border-radius: 2px;" class="mb-4"></div>

        <!-- Action Button -->
        <a href="<?= site_url('kasir/transaksi'); ?>"
           class="btn btn-lg px-5 py-3 text-white"
           style="background: linear-gradient(135deg, #E07A5F, #f4a183); border-radius: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); transition: 0.3s;">
          Mulai Transaksi Sekarang
        </a>

      </div>
    </div>
  </div>
</div>


  </div>
</main>
