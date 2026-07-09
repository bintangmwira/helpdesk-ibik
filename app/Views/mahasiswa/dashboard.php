<?php
/**
 * @var array $laporanList
 * @var int $totalAduan
 * @var int $totalDiproses
 * @var int $totalSelesai
 */
?>
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

        .nav-logo img {
            width: 180px;
            height: 50px;
            object-fit: contain;
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

        .icon-blue {
            background: #e0f2fe;
            color: #0284c7;
        }

        .icon-yellow {
            background: #fef3c7;
            color: #d97706;
        }

        .icon-green {
            background: #dcfce7;
            color: #16a34a;
        }

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

        /* New Styles for Forms, Tables and Badges */
        .main-grid {
            display: grid;
            grid-template-columns: 4.5fr 7.5fr;
            gap: 30px;
            margin-top: 30px;
        }

        @media (max-width: 992px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 15px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-control:focus {
            border-color: #4A154B;
            background: white;
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 21, 75, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4A154B 0%, #2C0630 100%);
            color: white;
            padding: 14px 24px;
            border-radius: 10px;
            border: none;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }

        .btn-primary:hover {
            opacity: 0.95;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 21, 75, 0.2);
        }

        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .data-table th {
            background: #f8f9fa;
            padding: 15px;
            font-weight: 600;
            color: #555;
            font-size: 14px;
            border-bottom: 2px solid #eee;
        }

        .data-table td {
            padding: 15px;
            font-size: 14px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .data-table tr:hover {
            background: #fcfcfd;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-status-menunggu {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .badge-status-diproses {
            background-color: #fef3c7;
            color: #b45309;
        }

        .badge-status-selesai {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-status-ditolak {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .badge-prio-rendah {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .badge-prio-sedang {
            background-color: #ffedd5;
            color: #ea580c;
        }

        .badge-prio-tinggi {
            background-color: #ffe4e6;
            color: #e11d48;
        }

        .btn-view {
            background: #efe9f5;
            color: #4A154B;
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            border: 1px solid rgba(74, 21, 75, 0.1);
        }

        .btn-view:hover {
            background: #4A154B;
            color: white;
            box-shadow: 0 4px 8px rgba(74, 21, 75, 0.15);
        }
    </style>
</head>
<body>

    <nav>
        <div class="nav-logo">
            <img src="<?= base_url('assets/images/logo-helpdesk-putih.png') ?>" alt="Logo Helpdesk">
        </div>

        <div class="nav-profile">
            <span>Halo, <?= esc(session()->get('nama')) ?></span>

            <a href="<?= base_url('logout') ?>" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </a>
        </div>
    </nav>

    <div class="dashboard-container">

        <!-- Flash Alert Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-xmark"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('validation')): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Format formulir tidak valid. Periksa kembali inputan Anda.
            </div>
        <?php endif; ?>

        <div class="welcome-card">
            <div class="welcome-text">
                <h2>Selamat Datang, <?= esc(session()->get('nama')) ?>!</h2>
                <p>
                    Anda masuk sebagai Mahasiswa. Gunakan portal ini untuk
                    melaporkan kendala akademik atau non-akademik Anda.
                </p>

                <div class="badge-role">
                    <i class="fa-solid fa-user-graduate"></i>
                    <?= esc(session()->get('role')) ?>
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
                    <div class="stat-number"><?= $totalAduan ?></div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fa-solid fa-paper-plane"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Sedang Diproses</h3>
                    <div class="stat-number"><?= $totalDiproses ?></div>
                </div>
                <div class="stat-icon icon-yellow">
                    <i class="fa-solid fa-spinner"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Selesai Ditanggapi</h3>
                    <div class="stat-number"><?= $totalSelesai ?></div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
            </div>

        </div>

        <!-- Main Complaint Grid -->
        <div class="main-grid">
            <!-- Left Side: Form Pengaduan -->
            <div class="content-panel">
                <div class="panel-header">
                    <h3><i class="fa-solid fa-pen-to-square"></i> Buat Pengaduan Baru</h3>
                </div>

                <form action="<?= base_url('mahasiswa/laporan/simpan') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="nama_pelapor">Nama Pelapor</label>
                        <input type="text" id="nama_pelapor" name="nama_pelapor" class="form-control" 
                               value="<?= esc(old('nama_pelapor', session()->get('nama'))) ?>" required>
                        <?php if (session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('nama_pelapor')): ?>
                            <span style="color:red; font-size:12px;"><?= session()->getFlashdata('validation')->getError('nama_pelapor') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="judul_laporan">Subjek / Judul Aduan</label>
                        <input type="text" id="judul_laporan" name="judul_laporan" class="form-control" 
                               placeholder="Contoh: Kesalahan Nilai UAS Matakuliah A" 
                               value="<?= esc(old('judul_laporan')) ?>" required>
                        <?php if (session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('judul_laporan')): ?>
                            <span style="color:red; font-size:12px;"><?= session()->getFlashdata('validation')->getError('judul_laporan') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori Aduan</label>
                        <select id="kategori" name="kategori" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <option value="Akademik" <?= old('kategori') == 'Akademik' ? 'selected' : '' ?>>Akademik</option>
                            <option value="Sarana & Prasarana" <?= old('kategori') == 'Sarana & Prasarana' ? 'selected' : '' ?>>Sarana & Prasarana</option>
                            <option value="Administrasi" <?= old('kategori') == 'Administrasi' ? 'selected' : '' ?>>Administrasi</option>
                            <option value="Keuangan" <?= old('kategori') == 'Keuangan' ? 'selected' : '' ?>>Keuangan</option>
                            <option value="Lain-lain" <?= old('kategori') == 'Lain-lain' ? 'selected' : '' ?>>Lain-lain</option>
                        </select>
                        <?php if (session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('kategori')): ?>
                            <span style="color:red; font-size:12px;"><?= session()->getFlashdata('validation')->getError('kategori') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="prioritas">Tingkat Prioritas</label>
                        <select id="prioritas" name="prioritas" class="form-control" required>
                            <option value="rendah" <?= old('prioritas') == 'rendah' ? 'selected' : '' ?>>Rendah (Bisa ditangani nanti)</option>
                            <option value="sedang" <?= old('prioritas') == 'sedang' ? 'selected' : '' ?>>Sedang (Butuh penanganan cepat)</option>
                            <option value="tinggi" <?= old('prioritas') == 'tinggi' ? 'selected' : '' ?>>Tinggi (Mendesak / Critical)</option>
                        </select>
                        <?php if (session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('prioritas')): ?>
                            <span style="color:red; font-size:12px;"><?= session()->getFlashdata('validation')->getError('prioritas') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Detail Kendala</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" 
                                  placeholder="Jelaskan secara rinci tentang kendala yang Anda alami..." required><?= esc(old('deskripsi')) ?></textarea>
                        <?php if (session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('deskripsi')): ?>
                            <span style="color:red; font-size:12px;"><?= session()->getFlashdata('validation')->getError('deskripsi') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="bukti_file">Upload Foto Bukti (Maks. 4MB)</label>
                        <input type="file" id="bukti_file" name="bukti_file" class="form-control" accept="image/*" required>
                        <?php if (session()->getFlashdata('validation') && session()->getFlashdata('validation')->hasError('bukti_file')): ?>
                            <span style="color:red; font-size:12px;"><?= session()->getFlashdata('validation')->getError('bukti_file') ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Pengaduan
                    </button>
                </form>
            </div>

            <!-- Right Side: Daftar Pengaduan -->
            <div class="content-panel">
                <div class="panel-header">
                    <h3><i class="fa-solid fa-list-check"></i> Daftar Pengaduan Saya</h3>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Subjek Aduan</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($laporanList)): ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; color: #888; padding: 30px;">
                                        <i class="fa-solid fa-folder-open" style="font-size: 40px; margin-bottom: 10px; display: block; opacity: 0.5;"></i>
                                        Belum ada pengaduan yang diajukan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($laporanList as $laporan): ?>
                                    <tr>
                                        <td><?= esc(date('d M Y, H:i', strtotime($laporan['tanggal_lapor']))) ?> WIB</td>
                                        <td>
                                            <strong><?= esc($laporan['judul_laporan']) ?></strong><br>
                                            <span style="font-size: 12px; color: #666;"><?= esc($laporan['kategori']) ?> - Oleh: <?= esc($laporan['nama_pelapor']) ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-prio-<?= esc($laporan['prioritas']) ?>">
                                                <?= esc($laporan['prioritas']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-status-<?= esc($laporan['status']) ?>">
                                                <?= esc($laporan['status']) ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="<?= base_url('mahasiswa/laporan/tiket/' . $laporan['id_laporan']) ?>" class="btn-view">
                                                <i class="fa-solid fa-ticket"></i> Lihat Tiket
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Academic Info Panel -->
        <div class="content-panel" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="panel-header">
                <h3><i class="fa-solid fa-circle-info"></i> Informasi Akademik</h3>
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
            </table>
        </div>

    </div>

</body>
</html>