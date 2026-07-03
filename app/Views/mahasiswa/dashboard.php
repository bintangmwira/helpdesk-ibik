<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Helpdesk IBIK</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: #f5f5f9;
            min-height: 100vh;
            color: #333;
        }

        /* Navbar */
        nav {
            background: linear-gradient(135deg, #4A154B 0%, #2C0630 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-logo i {
            font-size: 24px;
            color: #ffc107;
        }

        .nav-logo h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .nav-profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-profile span {
            font-weight: 500;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 8px 18px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background: #e02424;
            border-color: #e02424;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(224, 36, 36, 0.3);
        }

        /* Container */
        .dashboard-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(74, 21, 75, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            border-left: 6px solid #4A154B;
        }

        .welcome-text h2 {
            color: #4A154B;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .welcome-text p {
            color: #666;
            font-size: 15px;
        }

        .badge-role {
            background: #efe9f5;
            color: #4A154B;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-top: 10px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(74, 21, 75, 0.08);
        }

        .stat-info h3 {
            font-size: 14px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-info .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .icon-blue { background: #e0f2fe; color: #0284c7; }
        .icon-yellow { background: #fef3c7; color: #d97706; }
        .icon-green { background: #dcfce7; color: #16a34a; }

        /* Panel Info */
        .content-panel {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        }

        .panel-header {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .panel-header h3 {
            color: #4A154B;
            font-size: 20px;
            font-weight: 600;
        }

        .user-details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .user-details-table td {
            padding: 12px 15px;
            font-size: 15px;
        }

        .user-details-table td.label {
            font-weight: 600;
            color: #555;
            width: 250px;
        }

        .user-details-table tr:not(:last-child) {
            border-bottom: 1px dashed #eee;
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-logo">
            <i class="fa-solid fa-headset"></i>
            <h1>Helpdesk IBIK</h1>
        </div>
        <div class="nav-profile">
            <span>Halo, <?= esc(session()->get('nama')) ?></span>
            <a href="<?= base_url('logout') ?>" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </a>
        </div>
    </nav>

    <div class="dashboard-container">
        <div class="welcome-card">
            <div class="welcome-text">
                <h2>Selamat Datang, <?= esc(session()->get('nama')) ?>!</h2>
                <p>Anda masuk sebagai Mahasiswa. Gunakan portal ini untuk melaporkan kendala akademik atau non-akademik Anda.</p>
                <div class="badge-role">
                    <i class="fa-solid fa-user-graduate"></i> <?= esc(session()->get('role')) ?>
                </div>
            </div>
            <div style="font-size: 70px; color: #4A154B; opacity: 0.15; padding-right: 15px;">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Aduan Saya</h3>
                    <div class="stat-number">0</div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Sedang Diproses</h3>
                    <div class="stat-number">0</div>
                </div>
                <div class="stat-icon icon-yellow">
                    <i class="fa-solid fa-spinner"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Selesai Ditanggapi</h3>
                    <div class="stat-number">0</div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
            </div>
        </div>

        <div class="content-panel">
            <div class="panel-header">
                <h3>Informasi Akademik</h3>
            </div>
            <table class="user-details-table">
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td><?= esc(session()->get('nama')) ?></td>
                </tr>
                <tr>
                    <td class="label">NPM (Nomor Pokok Mahasiswa)</td>
                    <td><strong><?= esc(session()->get('npm')) ?></strong></td>
                </tr>
                <tr>
                    <td class="label">Alamat Email</td>
                    <td><?= esc(session()->get('email')) ?></td>
                </tr>
                <tr>
                    <td class="label">Status Koneksi Database</td>
                    <td><span style="color: #16a34a; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Terhubung</span></td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>
