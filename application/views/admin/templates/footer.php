<!--   Core JS Files   -->
<script src="<?php echo base_url()?>assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/core/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?php echo base_url()?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="<?php echo base_url()?>assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="<?php echo base_url()?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="<?php echo base_url()?>assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="<?php echo base_url()?>assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="<?php echo base_url()?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="<?php echo base_url()?>assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="<?php echo base_url()?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="<?php echo base_url()?>assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project!
    <script src="<?php echo base_url()?>assets/js/setting-demo.js"></script>
    <script src="<?php echo base_url()?>assets/js/demo.js"></script> -->


    <!-- DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>

    <!-- Script untuk menangani modal dan responsif -->
    <script>
    $(document).ready(function() {
        // Reset form saat modal ditutup
        $('#ubahAkunModal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
        });

        // Pastikan modal dapat dibuka kembali
        $('#ubahAkunModal').on('shown.bs.modal', function() {
            $(this).removeData('bs.modal');
        });

        // Toggle sidebar pada tampilan mobile
        $('.navbar-toggler').on('click', function() {
            $('.sidebar').toggleClass('show');
        });

        // Tutup sidebar saat mengklik di luar sidebar pada tampilan mobile
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.sidebar').length &&
                !$(e.target).closest('.navbar-toggler').length &&
                $('.sidebar').hasClass('show')) {
                $('.sidebar').removeClass('show');
            }
        });

        // Sesuaikan tampilan saat resize window
        $(window).resize(function() {
            if ($(window).width() > 991.98) {
                $('.sidebar').removeClass('show');
            }
        });

        // Deteksi ukuran layar dan tampilkan tombol yang sesuai
        function toggleNavbarButtons() {
            const isMobile = $(window).width() < 992; // Ukuran mobile kurang dari 992px
            const sidebarToggle = $('#sidebarToggle');
            const navbarToggler = $('#navbarToggler');

            if (isMobile) {
                sidebarToggle.hide(); // Sembunyikan sidebar toggle di mobile
                navbarToggler.show(); // Tampilkan navbar-toggler di mobile
            } else {
                sidebarToggle.show(); // Tampilkan sidebar toggle di desktop
                navbarToggler.hide(); // Sembunyikan navbar-toggler di desktop
            }
        }

        // Panggil fungsi saat halaman dimuat dan saat ukuran layar berubah
        toggleNavbarButtons();
        $(window).resize(toggleNavbarButtons);
    });

    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        if(preloader) {
            preloader.classList.add('fade-out');
            setTimeout(() => {
            preloader.style.display = 'none';
            }, 1500); 
        }
    });

    document.getElementById('logoutBtn').addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: "Sesi kamu akan diakhiri.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E07A5F',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo site_url('auth/logout'); ?>";
            }
        });
    });


    </script>


<!-- sidebar active -->

<script>
$(document).ready(function () {
  var currentUrl = window.location.href;

  // Loop setiap link di sidebar
  $('.sidebar-content .nav a').each(function () {
    var linkUrl = this.href;

    // Cek apakah URL cocok
    if (currentUrl === linkUrl || currentUrl.includes(linkUrl)) {

      // Tambahkan class active pada link ini (submenu seperti "Produk")
      $(this).addClass('active');

      // Tambahkan class active pada li-nya juga (untuk dot/ikon aktif)
      $(this).parent('li').addClass('active');

      // Kalau ada collapse (dropdown), buka juga
      var collapseDiv = $(this).closest('.collapse');
      if (collapseDiv.length) {
        collapseDiv.addClass('show');

        // Tambahkan juga class active pada menu utamanya (e.g. "Jenis/Produk")
        var toggleLink = collapseDiv.prev('a[data-bs-toggle="collapse"]');
        toggleLink.addClass('active');
        toggleLink.closest('.nav-item').addClass('active');
      }
    }
  });
});
</script>

<!-- wijett -->
<script>
  $(document).ready(function () {
    // Untuk tombol toggle Kaiadmin
    $('.toggle-sidebar, .sidenav-toggler').on('click', function () {
      $('body').toggleClass('sidebar_minimize');
    });

    // Jika ingin menyembunyikan dropdown collapse saat sidebar minimize
    $('body').on('click', '.nav-item > a[data-bs-toggle="collapse"]', function () {
      if ($('body').hasClass('sidebar_minimize')) {
        $('body').removeClass('sidebar_minimize');
      }
    });
  });
</script>

<style>

  .sidebar {
  transition: all 0.3s ease;
}

.sidebar_minimize .gg-menu-right {
  transform: rotate(180deg);
  transition: transform 0.3s ease;
}


</style>

 
  </body>
</html>