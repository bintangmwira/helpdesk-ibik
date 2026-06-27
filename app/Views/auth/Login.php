<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Helpdesk IBIK</title>

    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <!-- LEFT -->
    <div class="left">

        <div class="overlay"></div>

        <div class="content">

            <div class="logo">
                <i class="fa-solid fa-headset"></i>
                <span>HELPDESK IBIK</span>
            </div>

            <h3>Selamat Datang di</h3>

            <h1>HELPDESK IBIK</h1>

            <div class="line"></div>

            <p>
                Sistem layanan pengaduan mahasiswa yang memudahkan
                pelaporan berbagai kendala akademik maupun non akademik
                secara cepat, aman, dan transparan.
            </p>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="right">

        <form class="login-box">

            <h2>Login Account</h2>

            <p>
                Silakan login menggunakan akun mahasiswa
                untuk mengakses layanan Helpdesk IBIK.
            </p>

            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="Email">
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Password">
            </div>

            <div class="options">

                <label>
                    <input type="checkbox">
                    Ingat saya
                </label>

                <a href="#">Lupa Password?</a>

            </div>

            <button type="submit">
                LOGIN
            </button>

        </form>

    </div>

</div>

<script src="js/script.js"></script>

</body>
</html>