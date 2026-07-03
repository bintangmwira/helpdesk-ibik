<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk IBIK</title>

   <link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=' . time()) ?>">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <!-- LEFT (Sisi Ungu - Muncul di Desktop) -->
    <div class="left">
        <div class="overlay"></div>
        <div class="content">

            <div class="logo">
                <!-- Menggunakan Logo Putih dari gambar image_5f8d04.png -->
                <img src="<?= base_url('assets/images/logo-helpdesk-putih.png') ?>" alt="IBIK Helpdesk Logo" class="brand-img-white">
            </div>

            <h3>Selamat Datang di</h3>
            <h1>HELPDESK IBIK</h1>

            <div class="line"></div>

            <p>
                Sistem pengaduan mahasiswa untuk melaporkan kendala akademik dan non-akademik secara cepat, aman, dan transparan.
            </p>

        </div>
    </div>

    <!-- RIGHT (Sisi Form - Responsif) -->
    <div class="right">

        <!-- Form dialirkan ke proses login CodeIgniter asli -->
        <form class="login-box" action="<?= base_url('login/process') ?>" method="post">

            <!-- Logo Ungu muncul di atas form hanya ketika dibuka di HP -->
            <div class="mobile-logo-container">
                <img src="<?= base_url('assets/images/logo-helpdesk-ungu.png') ?>" alt="IBIK Helpdesk Logo" class="brand-img-purple">
            </div>

            <h2>Login Account</h2>

            <p class="subtitle">
                Silakan login menggunakan akun mahasiswa
                untuk mengakses layanan Helpdesk IBIK.
            </p>

            <!-- Menampilkan pesan error validasi/salah password dari CI -->
            <?php if(session()->getFlashdata('error')) : ?>
                <div class="alert-error">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="options">
                <label>
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>
                <a href="#">Lupa Password?</a>
            </div>

            <button type="submit">
                Masuk   
            </button>

        </form>

    </div>

</div>

<!-- Jika ingin menggunakan interaksi JS tambahan -->
<script src="<?= base_url('js/script.js') ?>"></script>

</body>
</html>