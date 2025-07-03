<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<div class="dashboard-header">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom mb-0">
      <li class="breadcrumb-item">
        <a href="<?php echo site_url('kasir/dashboard'); ?>">Beranda</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Produk</li>
    </ol>
  </nav>
</div>

<main class="main-content" style="padding: 45px 10px 10px; background-color: #f9f9f9;">
    <div class="container-fluid">
    <div class="row justify-content-center">


      <!-- Daftar Produk -->
      <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-3">
          <div class="card-header bg-white d-flex align-items-center justify-content-between flex-wrap gap-3">
            <form action="" method="GET" class="d-flex gap-2 flex-grow-1 max-w-400px">
              <input type="text" name="search"
                class="form-control form-control-sm rounded-3 border-2 shadow-sm"
                placeholder="Cari produk..."
                value="<?php echo $this->input->get('search'); ?>"
                style="box-shadow:none;" />

              <button type="submit" class="btn-sm rounded-0 px-3">
                <i class="fas fa-search"></i>
              </button>
            </form>
          </div>

            <!-- Card pembungkus kategori -->
          <div class="card p-4">
            <div class="kategori-wrapper d-flex gap-4 overflow-auto" style="white-space: nowrap; -webkit-overflow-scrolling: touch;">
              <!-- Tombol Semua -->
              <button class="btn filter-kategori active" data-kategori="" style="flex: 0 0 auto;">
                <div class="kategori-card d-flex flex-column align-items-center">
                  <div class="kategori-icon mb-1"><i class="bi bi-grid fs-4"></i></div>
                  <div class="kategori-text">Semua</div>
                </div>
              </button>

              <!-- Loop kategori -->
              <?php foreach ($categories as $cat): ?>
                <button class="btn filter-kategori" data-kategori="<?php echo $cat->id; ?>" style="flex: 0 0 auto;">
                  <div class="kategori-card d-flex flex-column align-items-center">
                    <div class="kategori-icon mb-1">
                      <i class="fa-solid fa-utensils fs-4"></i>
                    </div>
                    <div class="kategori-text">
                      <?php echo htmlspecialchars($cat->nama_kategori); ?>
                    </div>
                  </div>
                </button>
              <?php endforeach; ?>
            </div>
          </div>



          <div class="card-body bg-white" style="max-height: 40vh; overflow-y: auto;">
            <div class="row" id="product-list">
              <?php foreach ($products as $product): ?>
                <div class="col-md-4 product-item" data-kategori="<?= $product->kategori_id; ?>">
                  <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">

                    <!-- Gambar produk -->
                    <div class="position-relative overflow-hidden" style="height: 150px;">
                      <img src="<?= base_url('./uploads/produk/' . $product->gambar); ?>" 
                        alt="<?= $product->nama_produk; ?>"
                        class="card-img-top img-fluid rounded-0"
                        style="height: 100%; width: 100%; object-fit: cover; transition: transform 0.3s;">
                    </div>

                    <!-- Isi card -->
                    <div class="card-body d-flex flex-column  p-3">
                      <div>
                        <h6 class="fw-semibold text-dark mb-1" style="font-size: 1rem;">
                          <?= $product->nama_produk; ?>
                        </h6>
                        <div class="d-flex justify-content-between align-items-center">
                          <span class="text-muted" style="font-size: 0.9rem;">
                            Rp <?= number_format($product->harga, 0, ',', '.'); ?>
                          </span>
                          <span class="stok-display badge rounded-pill">Stok: <?php echo $product->stok; ?></span>
                        </div>
                      </div>

                      <!-- Tombol input -->
                      <button type="button"
                        class="btn btn-sm mt-3 w-100 rounded-pill add-item"
                        style="background-color: #E07A5F; border-color: #E07A5F; color: #fff; transition: background-color 0.3s;"
                        data-id="<?= htmlspecialchars($product->id); ?>"
                        data-nama="<?= htmlspecialchars($product->nama_produk); ?>"
                        data-harga="<?= htmlspecialchars($product->harga); ?>"
                        data-stok="<?= htmlspecialchars($product->stok); ?>"
                        data-gambar="<?= base_url('./uploads/produk/' . $product->gambar); ?>"
                        <?= $product->stok <= 0 ? 'disabled' : ''; ?>>
                        <i class="fas fa-cart-plus me-2"></i> Masukkan
                      </button>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Keranjang -->
      <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-3 h-70 d-flex flex-column">
          <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-semibold" style="color:#333;">Input Order</h5>
          </div>
          <div class="card-body flex-grow-1 d-flex flex-column">
            <form id="transaction-form" action="<?php echo site_url('kasir/transaksi/process'); ?>" method="post" class="d-flex flex-column h-100">

            <div class="table-responsive mb-3 cart-scroll">
                <table class="table table-borderless table-sm align-middle" id="cart-table" style="min-width: 100%;">
                  <thead class="table-header-sticky">
                    <tr style="border-bottom: 1px solid #e9ecef;">
                      <th style="width: 45%;">Produk</th>
                      <th style="width: 15%;">Qty</th>
                      <th style="width: 25%;">Subtotal</th>
                      <th style="width: 15%;"></th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>

             <!-- Bagian total & bayar -->
              <div class="pembayaran-section">
                <div class="total-box mb-3 d-flex justify-content-between align-items-center">
                  <label class="form-label mb-0 flex-grow-1" style="max-width: 120px;">Total</label>
                  <input type="text" class="form-control text-end fw-semibold" id="total" name="total" readonly />
                </div>

                <div class="total-box mb-3 d-flex justify-content-between align-items-center">
                  <label class="form-label mb-0 flex-grow-1" style="max-width: 120px;">Bayar</label>
                  <input type="number" class="form-control text-end" id="bayar" name="bayar" required />
                </div>

                <div class="total-box mb-3 d-flex justify-content-between align-items-center">
                  <label class="form-label mb-0 flex-grow-1" style="max-width: 120px;">Kembali</label>
                  <input type="text" class="form-control text-end fw-semibold" id="kembali" readonly />
                </div>

                <button type="submit" class="btn-warning btn-pembayaran w-100 mt-3">Pembayaran</button>
              </div>

              
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>

  <!-- Template untuk item keranjang, dengan gambar -->
    <template id="cart-item-template">
      <tr data-id="{id}" class="align-middle" style="border-bottom:1px solid #e9ecef;">
        <td>
          <input type="hidden" name="items[{index}][id]" value="{id}">
          <input type="hidden" name="items[{index}][subtotal]" value="{subtotal}">
          <div class="d-flex align-items-center gap-2">
            <img src="{gambar}" alt="{nama}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px;">
            <span class="fw-semibold" style="color:#222;">{nama}</span>
          </div>
        </td>
        <td>
          <input type="number" class="form-control form-control-sm qty-input text-end" 
            name="items[{index}][qty]" value="1" min="1" max="{stok}" 
            style="border-radius: 0.375rem;" data-harga="{harga}">
        </td>
        <td class="subtotal fw-semibold" style="color:#333;">Rp {subtotal_format}</td>
        <td>
          <button type="button" class="btn btn-outline-danger btn-sm remove-item rounded-circle p-1" title="Hapus item">
            <i class="fas fa-times"></i>
          </button>
        </td>
      </tr>
    </template>


<style> 


  /* Reset dan dasar */
  .filter-kategori:focus {
    outline: none !important;
    box-shadow: none !important;
  }

  body {
    background-color: #F9FAFB;
     /* font-family: 'Poppins'; */
    color: #333;
    margin: 0;
    padding: 0;
  }

  .product-item .card:hover img {
    transform: scale(1.05);
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

  .add-item:hover {
    background-color: #0056b3 !important;
  }

  .badge.bg-secondary {
    background-color: #6c757d !important;
  }

  /* slider */
  .kategori-wrapper {
  -ms-overflow-style: none;  /* Internet Explorer 10+ */
  scrollbar-width: none;     /* Firefox */
}

.kategori-wrapper::-webkit-scrollbar {
  display: none;             /* Safari and Chrome */
}

  /* Container utama */
  .main-content {
    padding: 1rem;
  }

  /* Card umum */
  .card {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
    border: none;
  }

  /* Header card */
  .card-header {
    background-color: #fff;
    border-bottom: 1px solid #e9ecef;
    /* padding: 1rem 1.5rem; */
    display: flex;
    /* align-items: center; */
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
  }

  .card-header h5 {
    font-weight: 600;
    color: #222;
    margin: 0;
    flex-shrink: 0;
  }

  /* Form pencarian */
  .card-header form.d-flex {
    flex-grow: 1;
    max-width: 100%;
    height: 50px;
    display: flex;
    align-items: stretch;
  }

  .card-header input[type="text"] {
    border-radius: 6px 0 0 16px; /* hanya kiri yang membulat */
    border: 1px solid #ced4da;
    box-shadow: none;
    padding: 0.375rem 1rem;
    font-size: 0.9rem;
    flex-grow: 1;
  }

  .card-header input[type="text"]:focus {
    outline: none;
    border-color: #6c757d;
    box-shadow: 0 0 5px rgba(152,116,86,0.5);
  }

  .card-header button.btn {
    border-radius: 0 6px 6px 0; /* hanya kanan yang membulat */
    padding: 0 1.2rem;
    border: 1px solid #ced4da;
    border-left: none; /* agar tidak dobel border di tengah */
    color: white;
    font-size: 1rem;
    cursor: pointer;
  }

  /* Filter kategori */
  .kategori-wrapper .filter-kategori {
    padding: 8px;
    border: 0;
    background: none;
  }

  .kategori-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 130px;
    height: 130px;
    border-radius: 16px;
    background-color: #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    text-align: center;
    transition: 0.2s ease-in-out;
    padding: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
    margin: 6px; /* jarak luar antar card */
  }

  .kategori-card:hover,
  .filter-kategori.active .kategori-card {
    background-color: rgb(226, 211, 207);
    box-shadow: 0 0 0 2px #E07A5F;
  }

  .kategori-icon {
    margin-bottom: 6px;
    font-size: 24px;
    color: #E07A5F;
  }

  .kategori-icon img {
    height: 32px;
  }

  .kategori-text {
    font-weight: bold;
    font-size: 14px;
    color: #333;
     -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;     /* Firefox */
  }

   /* sintax hilangkan warna biru hover di transaksi */

    .btn.filter-kategori,
    .btn.filter-kategori:hover,
    .btn.filter-kategori:focus,
    .btn.filter-kategori:active {
      background-color:rgb(253, 253, 252) !important;
      color: white !important;
      outline: none !important;
      box-shadow: none !important;
      -webkit-tap-highlight-color: transparent;
      -webkit-focus-ring-color: transparent;
    }



    .btn.filter-kategori {
      -webkit-tap-highlight-color: transparent; /* Untuk Android WebView */
      -webkit-focus-ring-color: transparent;    /* Safari */
    }

    /* end transaksi */

  /* Produk card */
  .card-body {
    background-color: #fff;
    padding: 1rem 1.5rem;
  }

  .card-body::-webkit-scrollbar {
  display: none;
}

  .product-item .card {
    border-radius: 12px;
    box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
    border: none;
    transition: box-shadow 0.3s ease;
    cursor: pointer;
  }

  .product-item .card:hover {
    box-shadow: 0 6px 18px rgb(0 0 0 / 0.1);
  }

  .product-item img.card-img-top {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    object-fit: cover;
  }

  .card-body h6.card-title {
    font-weight: 600;
    font-size: 1rem;
    color: #222;
    margin-bottom: 0.3rem;
  }

  .card-body p.card-text {
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 0.8rem;
  }

  .stok-display {
    font-size: 0.85rem;
    color: #777;
  }

  /* Tombol input produk */
  .add-item {
    background-color: #987456;
    color: white;
    border-radius: 9999px;
    font-weight: 600;
    padding: 0.375rem 0;
    transition: background-color 0.3s ease;
    border: none;
    font-size: 0.9rem;
  }

  .add-item i {
    margin-right: 6px;
  }

  .add-item:hover:not(:disabled) {
    background-color: #7a5b3e;
  }

  .add-item:disabled {
    background-color: #ccc;
    cursor: not-allowed;
  }

  /* ==================== Kartu (Card) Utama ==================== */
  .card.shadow-sm {
    border-radius: 18px;
    border: none;
    background-color: #ffffff;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    overflow: hidden;
  }

  /* ==================== Header ==================== */
  .card-header.bg-white {
    background-color: #ffffff;
    border-bottom: 1px solid #f0f0f0;
    padding: 1rem 1.5rem;
  }

  .card-header h5 {
    margin-bottom: 0;
    font-size: 1.2rem;
    font-weight: 700;
    color: #2d3436;
  }

  /* ==================== Table Keranjang ==================== */
  #cart-table {
    font-size: 0.95rem;
    color: #2d3436;
  }

  #cart-table thead th {
    font-weight: 600;
    font-size: 0.85rem;
    color: #636e72;
    border-bottom: 1px solid #e0e0e0;
  }

  #cart-table tbody tr {
    border-bottom: 1px solid #f1f3f5;
  }

  #cart-table td {
    padding: 0.75rem 0.5rem;
    vertical-align: middle;
  }

  /* Gambar produk */
  #cart-table img {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    object-fit: cover;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
  }

  #cart-table .fw-semibold {
    font-weight: 600;
    font-size: 0.95rem;
    color: #2d3436;
  }

  /* Input jumlah (Qty) */
  .qty-input {
    width: 60px;
    height: 36px;
    border-radius: 10px;
    text-align: center;
    font-size: 0.9rem;
    border: 1px solid #ced4da;
  }

  /* Tombol hapus item */
  .remove-item {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #d63031;
    border: 1px solid #d63031;
    background-color: transparent;
    transition: all 0.2s ease;
  }

  .remove-item:hover {
    background-color: #d63031;
    color: white;
  }

  /* ==================== Input Total, Bayar, Kembali ==================== */
  .card-body label.form-label {
    font-weight: 600;
    font-size: 1rem;
    color: #2d3436;
  }

  .card-body input.form-control {
    height: 38px;
    font-size: 1rem;
    border-radius: 10px;
  }

  /* Readonly input style */
  .card-body input[readonly] {
    background-color: rgb(242, 243, 246);
    font-weight: 600;
    border: none;
    color: rgb(98, 11, 124);
  }

  /* Input jumlah bayar */
  .card-body input[type="number"] {
    border: 1px solid #ced4da;
  }

  /* ==================== Tombol Metode Pembayaran ==================== */
  .btn-metode {
    flex: 1;
    padding: 0.6rem 1rem;
    border-radius: 10px;
    border: 2px solid #dcdde1;
    background-color: #f5f6fa;
    color: #2d3436;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    text-align: center;
  }

  .btn-metode:hover {
    background-color: #dcdde1;
  }

  .btn-metode.active {
    background-color: #E07A5F;
    color: white;
  }

  /* slide keranjang */
     .cart-scroll {
      max-height: 270px; /* 3 item tinggi sekitaran 80px/item */
      overflow-y: auto;
      padding-right: 4px; /* biar scroll ga nutupi konten */
      scroll-behavior: smooth;
    }

    .cart-scroll::-webkit-scrollbar {
      display: none;                /* Chrome & Safari */
    }

    .table-header-sticky th {
      position: sticky;
      top: 0;
      background-color: #fff;         /* Pastikan latar belakang solid */
      z-index: 1;
    }

    .pembayaran-section {
      margin-top: 24px; /* atau 24px biar lebih longgar */
    }

  /* ==================== Tombol Tipe Pesanan (Takeaway / Dine In) ==================== */
  .btn-tipe-pesanan {
    flex: 1;
    padding: 0.6rem 1rem;
    border-radius: 10px;
    border: 2px solid #dcdde1;
    background-color: #f5f6fa;
    color: #2d3436;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    text-align: center;
  }

  .btn-tipe-pesanan:hover {
    background-color: #dcdde1;
  }

  .btn-tipe-pesanan.active {
    background-color: #E07A5F;
    color: white;
  }

  /* tombol input */
  .add-item:hover {
    background-color: #cc6550 !important;
    border-color: #cc6550 !important;
  }

  /* total,kembali, bayar juga button pembayaran */
  .total-box label {
    margin-right: 1rem; /* jarak antar label dan input */
    font-size: 1.05rem;
    font-weight: 600;
    color: #333;
    white-space: nowrap;
  }

  .total-box input.form-control {
    max-width: 150px;
    font-size: 1.05rem;
  }

  .btn-warning {
    background-color: #E07A5F !important;
    border-radius: 5px;
    height: 35px;
    color: white !important;
  }

  .btn-warning:hover {
    background-color: #c25d46 !important;
    border-color: #c25d46 !important;
  }

  /* Responsive tweaks */
  @media (max-width: 768px) {
    .card-header form.d-flex {
      max-width: 100%;
    }
    .filter-kategori {
      font-size: 0.8rem;
      padding: 0.25rem 0.75rem;
    }
  }
  
</style>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    let cartItems = {};

    // Filter produk berdasarkan kategori
    $('.filter-kategori').click(function() {
        const kategoriId = $(this).data('kategori');
        $('.filter-kategori').removeClass('btn-primary').addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary').addClass('btn-primary');

        if(kategoriId === '' || kategoriId === undefined) {
            $('.product-item').show();
        } else {
            $('.product-item').each(function() {
                if($(this).data('kategori') == kategoriId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });

    // Tambah item ke keranjang
$('.add-item').click(function() {
    const button = $(this);
    const id = button.data('id');
    const nama = button.data('nama');
    const harga = button.data('harga');
    const stok = button.data('stok');
    const gambar = button.data('gambar');

    if(stok <= 0) {
        alert('Stok produk habis');
        return;
    }

    document.querySelector('.cart-scroll').scrollTop = 0;

    if(cartItems[id]) {
        let currentQty = cartItems[id].qty;
        if(currentQty < stok) {
            cartItems[id].qty = currentQty + 1;
            cartItems[id].subtotal = (currentQty + 1) * harga;

            const row = $(`tr[data-id="${id}"]`);
            row.find('.qty-input').val(currentQty + 1);
            row.find('.subtotal').text('Rp ' + formatRupiah(cartItems[id].subtotal));
            row.find('input[name$="[subtotal]"]').val(cartItems[id].subtotal);

            // Pindahkan baris produk ke atas
            row.prependTo('#cart-table tbody');

            const newStok = stok - cartItems[id].qty;
            button.closest('.card-body').find('.stok-display').text(`Stok: ${newStok}`);

            if(newStok === 0) {
                button.prop('disabled', true);
            }
        } else {
            alert('Stok tidak mencukupi');
        }
    } else {
        cartItems[id] = {
            id: id,
            nama: nama,
            harga: harga,
            qty: 1,
            subtotal: harga,
            gambar: gambar
        };

        let template = $('#cart-item-template').html()
            .replace(/{index}/g, id)
            .replace(/{id}/g, id)
            .replace(/{nama}/g, nama)
            .replace(/{harga}/g, harga)
            .replace(/{stok}/g, stok)
            .replace(/{subtotal}/g, harga)
            .replace(/{subtotal_format}/g, formatRupiah(harga))
            .replace(/{gambar}/g, gambar);

        // Tambahkan produk baru di paling atas
        $('#cart-table tbody').prepend(template);

        const newStok = stok - 1;
        const row = $(`tr[data-id="${id}"]`);
        button.closest('.card-body').find('.stok-display').text(`Stok: ${newStok}`);


        if(newStok === 0) {
            button.prop('disabled', true);
        }
    }

    updateTotal();
});


    // Update subtotal saat quantity berubah
    $(document).on('change', '.qty-input', function() {
        const row = $(this).closest('tr');
        const id = row.data('id');
        let qty = parseInt($(this).val());
        const harga = $(this).data('harga');
        const maxStok = parseInt($(this).attr('max'));

        if(qty < 1) {
            qty = 1;
            $(this).val(qty);
        }
        if(qty > maxStok) {
            qty = maxStok;
            $(this).val(qty);
        }

        const subtotal = qty * harga;
        cartItems[id].qty = qty;
        cartItems[id].subtotal = subtotal;

        row.find('input[name$="[subtotal]"]').val(subtotal);
        row.find('.subtotal').text('Rp ' + formatRupiah(subtotal));

        const button = $(`.add-item[data-id="${id}"]`);
        const originalStok = parseInt(button.data('stok'));
        const newStok = originalStok - qty;
        button.closest('.card-body').find('.stok-display').text(`Stok: ${newStok}`);

        if(newStok === 0) {
            button.prop('disabled', true);
        } else {
            button.prop('disabled', false);
        }

        updateTotal();
    });

    // Hapus item dari keranjang
    $(document).on('click', '.remove-item', function() {
        const row = $(this).closest('tr');
        const id = row.data('id');

        const button = $(`.add-item[data-id="${id}"]`);
        const originalStok = parseInt(button.data('stok'));

        button.closest('.card-body').find('.stok-display').text(`Stok: ${originalStok}`);
        button.prop('disabled', false);

        delete cartItems[id];
        row.remove();
        updateTotal();
    });

    // Update total dan kembalian
    function updateTotal() {
        let total = 0;
        Object.values(cartItems).forEach(item => {
            total += parseInt(item.subtotal);
        });

        $('#total').val(total);
        updateKembalian();
    }

    $('#bayar').on('input', updateKembalian);

    function updateKembalian() {
        const total = parseInt($('#total').val()) || 0;
        const bayar = parseInt($('#bayar').val()) || 0;
        const kembali = bayar - total;

        $('#kembali').val(kembali);
    }

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(parseInt(number));
    }

    // Validasi form sebelum submit
    $('#transaction-form').submit(function(e) {
        const total = parseInt($('#total').val()) || 0;
        const bayar = parseInt($('#bayar').val()) || 0;

        if(total === 0) {
            alert('Keranjang masih kosong');
            e.preventDefault();
            return;
        }

        if(bayar < total) {
            alert('Pembayaran kurang');
            e.preventDefault();
            return;
        }

        const items = Object.values(cartItems).map(item => ({
            id: item.id,
            qty: item.qty,
            subtotal: item.subtotal
        }));

        $('#transaction-form').append(`
            <input type="hidden" name="items" value='${JSON.stringify(items)}'>
        `);
    });
});
</script>

<!-- script hover di transaksi -->

<script>
  document.querySelectorAll('.filter-kategori').forEach(button => {
    button.addEventListener('click', function () {
      // Hapus 'active' dari semua tombol
      document.querySelectorAll('.filter-kategori').forEach(btn => {
        btn.classList.remove('active');
      });

      // Tambahkan 'active' hanya ke tombol yang diklik
      this.classList.add('active');
    });
  });
</script>