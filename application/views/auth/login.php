<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #E07A5F, #F6E7D7);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container-login {
            display: flex;
            width: 90%;
            max-width: 1000px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .login-box {
            flex: 1;
            padding: 3rem;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 2.5rem;
            color: #E07A5F;
            font-weight: 600;
        }

        .login-header .icon {
            font-size: 3rem;
            color: #E07A5F;
        }

        .login-image {
    flex: 1;
    position: relative;
    overflow: hidden;
    background: #eee;
}

.login-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease, opacity 1s ease;
}

.login-image:hover img {
    transform: scale(1.1);
}

        
    </style>
</head>
<body>

    <div class="container-login">
        <div class="login-box">
            <div class="login-header">
                <i class="fas fa-user-circle icon"></i>
                <h1>SalakTani</h1>
                <p class="text-muted">Sistem login Admin</p>
            </div>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo site_url('auth/login'); ?>" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <button type="submit" class="btn w-100 text-white" style="background-color: #E07A5F; border: none;">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </button>
            </form>
        </div>

        <div class="login-image">
    <img id="slideshow" src="<?php echo base_url('uploads/produk/ilus1.jpg'); ?>" alt="Kebun Salak">
</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    const images = [
        "<?php echo base_url('uploads/produk/ilus2.jpg'); ?>",
        "<?php echo base_url('uploads/produk/ilus.jpg'); ?>",
    ];
      index = 0;
    const slideshow = document.getElementById('slideshow');

    setInterval(() => {
        index = (index + 1) % images.length;
        slideshow.style.opacity = 0;
        setTimeout(() => {
            slideshow.src = images[index];
            slideshow.style.opacity = 1;
        }, 500); // waktu jeda antar fade
    }, 4000); // waktu setiap gambar tampil (4 detik)
</script>
</html>

