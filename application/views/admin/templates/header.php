<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Penjualan</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <link rel="icon" href="<?php echo base_url()?>assets/img/kaiadmin/favicon.ico" type="image/x-icon"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <!-- Fonts and icons -->
    <script src="<?php echo base_url()?>assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["<?php echo base_url()?>assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });

      document.addEventListener("DOMContentLoaded", function () {
        const activeLink = document.querySelector(".nav-item.active > a");
        if (activeLink) {
          activeLink.style.backgroundColor = "rgba(224, 122, 95, 0.1)";
          activeLink.style.boxShadow = "inset 4px 0 0 0 #E07A5F";
          activeLink.style.color = "#E07A5F";
        }

        const icon = document.querySelector(".nav-item.active > a > i");
        if (icon) {
          icon.style.color = "#E07A5F";
        }
      });
      
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/plugins.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/demo.css" />
  </head>

  <style>
    .sidebar .nav p,
    .sidebar .nav span,
    .sidebar .text-section {
      font-family: 'Poppins', sans-serif !important;
    }
    .navbar-nav,
    .dropdown-menu,
    .profile-username,
    .navbar-form input,
    .notif-content span,
    .dropdown-title,
    .user-box .u-text {
      font-family: 'Poppins', sans-serif !important;
    }
    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 10px; /* Jarak antara ikon dan teks */
      text-decoration: none;
    }
    #preloader {
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    #preloader i {
        font-size: 60px;
        animation: shake 1.5s infinite;
        color: #28a745;
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-10px); }
        40%, 80% { transform: translateX(10px); }
    }
    main {
        padding: 20px;
    }
    #preloader.fade-out {
        opacity: 0;
        visibility: hidden;
        transition: opacity 1.5s ease-in-out, visibility 1.5s ease-in-out;
    }
    .gradient-logo {
      background: linear-gradient(45deg, #7B3F00, #FF7F50); /* Gradasi Terakota */
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
    }
    .gradient-icon {
      font-size: 35px;
      background: linear-gradient(45deg, #7B3F00, #FF7F50);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
    }
    .gradient-text {
      font-size: 28px;
      font-weight: bold;
      background: linear-gradient(45deg, #7B3F00, #FF7F50);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
    }
    html body .sidebar .nav .nav-item.active > a {
      background-color: rgba(224, 122, 95, 0.1) !important;
      box-shadow: inset 4px 0 0 0 #E07A5F !important;
      color: #E07A5F !important;
      border-left: none !important; 
    }
    html body .sidebar .nav .nav-item.active > a > i {
      color: #E07A5F !important;
      fill: #E07A5F !important; 
    }
    html body .sidebar .nav .nav-item.active > a > p {
      color: #E07A5F !important;
    }
    html body .sidebar .nav .nav-item.active > a::before {
      background-color: #E07A5F !important;
    }
    .nav-toggle i.gg-menu-right,
    .nav-toggle i.gg-menu-left {
      color: #E07A5F !important; /* warna terakota */
    }
    .nav-toggle i.gg-menu-right:hover,
    .nav-toggle i.gg-menu-left:hover {
      color: #B35B43 !important; /* warna terakota gelap saat hover */
    }
    .gg-more-vertical-alt {
      color: #B35B43 !important; /* warna terakota gelap saat hover */
    }
    .btn-home i {
      font-size: 20px;
      color: #d3d3d3;
      margin-left: -20px;
    }
    .sidebar-wrapper,
    .sidebar-content {
      padding-top: 0 !important;
      margin-top: 0 !important;
    }

    .nav.nav-secondary {
      margin-top: 0 !important;
      padding-top: 0 !important;
    }
  </style>

<!-- untuk gambar avatarnya -->
<?php
$CI =& get_instance();
$CI->load->model('Profile_model');
$id = $CI->session->userdata('user_id');
$user = $CI->Profile_model->get_profile($id);
?>

<body>

<!-- Preloader -->
<div id="preloader" style="position:fixed;top:0;left:0;width:100vw;height:100vh;background:#fff;display:flex;justify-content:center;align-items:center;z-index:9999;">
    <i class="fas fa-leaf" style="font-size: 60px; animation: shake 1.5s infinite; color: #E07A5F;"></i>
</div>

<!-- Sidebar -->
      <div class="sidebar" data-background-color="light">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="light">
            <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo">
              <img
                src="<?php echo base_url() ?>assets/img/logo.jpg"
                alt="navbar brand"
                class="navbar-brand"
                style="height: 30px; max-height: 100%; margin-left: -10px;" 
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
  </div>

  <div class="sidebar-wrapper scrollbar scrollbar-inner" style="padding-top: 0;">
    <div class="sidebar-content" style="padding-top: 0; margin-top: 0;">
      <ul class="nav nav-secondary" style="position: relative; top: 0px;">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Section Title -->
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">menu</h4>
        </li>

        <!-- Jenis / Produk -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#base" aria-expanded="false" aria-controls="base">
          <i class="fas  fa-list"></i>
            <p>Jenis/Produk</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="base">
            <ul class="nav nav-collapse">
              <li>
                <a href="<?php echo site_url('admin/kategori'); ?>">
                  <span class="sub-item">Jenis Produk</span>
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('admin/produk'); ?>">
                  <span class="sub-item">Produk</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Transaksi -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayouts" aria-expanded="false" aria-controls="sidebarLayouts">
          <i class="fas fa-shopping-cart"></i>
            <p>Transaksi</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayouts">
            <ul class="nav nav-collapse">
              <li>
                <a href="<?php echo site_url('admin/transaksi'); ?>">
                  <span class="sub-item">Input Order</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Data Pengguna -->
        <li class="nav-item">
          <a href="<?php echo site_url('admin/pengguna'); ?>">
            <i class="fas fa-users"></i>
            <p>Data Pengguna</p>
          </a>
        </li>

        <!-- Laporan -->
        <li class="nav-item">
          <a href="<?php echo site_url('admin/penjualan'); ?>">
            <i class="fas fa-file-alt"></i>
            <p>Laporan</p>
          </a>
        </li>

      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->

      <d class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="<?php echo base_url()?>assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
              <!-- <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                  </div>
                  <input type="text" placeholder="Search ..." class="form-control"/>
                </div>
              </nav> -->
              <nav class="navbar navbar-header-left navbar-expand-lg p-0 d-none d-lg-flex">
                <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-home" title="Home">
                  <i class="fa fa-home"></i>
                </a>
              </nav>


              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input type="text" placeholder="Search ..." class="form-control" />
                      </div>
                    </form>
                  </ul>
                </li>

                <!-- <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-envelope"></i>
                  </a>
                  <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                    <li>
                      <div class="dropdown-title d-flex justify-content-between align-items-center">
                        Messages
                        <a href="#" class="small">Mark all as read</a>
                      </div>
                    </li>
                    <li>
                      <div class="message-notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-img">
                              <img src="<?php echo base_url()?>assets/img/jm_denis.jpg" alt="Img Profile"/>
                            </div>
                            <div class="notif-content">
                              <span class="subject">Jimmy Denis</span>
                              <span class="block"> How are you ? </span>
                              <span class="time">5 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img src="<?php echo base_url()?>assets/img/chadengle.jpg" alt="Img Profile"/>
                            </div>
                            <div class="notif-content">
                              <span class="subject">Chad</span>
                              <span class="block"> Ok, Thanks ! </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img src="<?php echo base_url()?>assets/img/mlane.jpg" alt="Img Profile"/>
                            </div>
                            <div class="notif-content">
                              <span class="subject">Jhon Doe</span>
                              <span class="block"> Ready for the meeting today... </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img src="<?php echo base_url()?>assets/img/talha.jpg" alt="Img Profile"/>
                            </div>
                            <div class="notif-content">
                              <span class="subject">Talha</span>
                              <span class="block"> Hi, Apa Kabar ? </span>
                              <span class="time">17 minutes ago</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
              
                    <li>
                      <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i></a>
                    </li>
                  </ul>
                </li> -->

                <!-- <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="notification">4</span>
                  </a>
                  <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                      <div class="dropdown-title"> You have 4 new notification </div>
                    </li>
                    <li>
                      <div class="notif-scroll scrollbar-outer">
                        <div class="notif-center">
                          <a href="#">
                            <div class="notif-icon notif-primary">
                              <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> New user registered </span>
                              <span class="time">5 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-success">
                              <i class="fa fa-comment"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Rahmad commented on Admin
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="<?php echo base_url()?>assets/img/profile2.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Reza send messages to you
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-danger">
                              <i class="fa fa-heart"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> Farrah liked Admin </span>
                              <span class="time">17 minutes ago</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i></a>
                    </li>
                  </ul>
                </li> -->

                <!-- <li class="nav-item topbar-icon dropdown hidden-caret">
                  <a
                    class="nav-link"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                    <i class="fas fa-layer-group"></i>
                  </a>
                  <div class="dropdown-menu quick-actions animated fadeIn">
                    <div class="quick-actions-header">
                      <span class="title mb-1">Quick Actions</span>
                      <span class="subtitle op-7">Shortcuts</span>
                    </div>
                    <div class="quick-actions-scroll scrollbar-outer">
                      <div class="quick-actions-items">
                        <div class="row m-0">
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div class="avatar-item bg-danger rounded-circle">
                                <i class="far fa-calendar-alt"></i>
                              </div>
                              <span class="text">Calendar</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-warning rounded-circle"
                              >
                                <i class="fas fa-map"></i>
                              </div>
                              <span class="text">Maps</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div class="avatar-item bg-info rounded-circle">
                                <i class="fas fa-file-excel"></i>
                              </div>
                              <span class="text">Reports</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-success rounded-circle"
                              >
                                <i class="fas fa-envelope"></i>
                              </div>
                              <span class="text">Emails</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-primary rounded-circle"
                              >
                                <i class="fas fa-file-invoice-dollar"></i>
                              </div>
                              <span class="text">Invoice</span>
                            </div>
                          </a>
                          <a class="col-6 col-md-4 p-0" href="#">
                            <div class="quick-actions-item">
                              <div
                                class="avatar-item bg-secondary rounded-circle"
                              >
                                <i class="fas fa-credit-card"></i>
                              </div>
                              <span class="text">Payments</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li> -->

                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    href="#"
                    aria-expanded="false"
                  >
                  <div class="avatar-sm">
                    <img
                      src="<?php echo base_url('uploads/profile/admin/' . (!empty($user->gambar) ? $user->gambar : 'pic.jpg')); ?>"
                      alt="Profile Picture"
                      class="avatar-img rounded-circle"
                    />
                  </div>
                    <span class="profile-username">
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold"><?= $this->session->userdata('nama'); ?></span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                          <img
                            src="<?php echo base_url('uploads/profile/admin/' . (!empty($user->gambar) ? $user->gambar : 'pic.jpg')); ?>"
                            alt="image profile"
                            class="avatar-img rounded"
                          />
                          </div>
                          <div class="u-text" style="display: flex; justify-content: center; align-items: center;">
                            <h4>Admin</h4>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('admin/profile') ?>">Perbarui Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" id="logoutBtn">
                          <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>