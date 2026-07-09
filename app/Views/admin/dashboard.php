<?php
/**
 * @var array $laporanList
 * @var array|null $tanggapanList
 * @var int $totalLaporan
 * @var int $laporanBaru
 * @var int $selesaiDiproses
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Helpdesk IBIK</title>
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

        /* Styling for Table, Alerts, Badges and Modal */
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

        .table-responsive {
            overflow-x: auto;
            margin-top: 15px;
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

        .btn-action {
            background: #4A154B;
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-view-ticket {
            background: #efe9f5;
            color: #4A154B;
            padding: 8px 14px;
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

        .btn-view-ticket:hover {
            background: #4A154B;
            color: white;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: white;
            border-radius: 16px;
            width: 90%;
            max-width: 650px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            animation: slideDown 0.3s ease;
            overflow: hidden;
        }

        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            background: linear-gradient(135deg, #4A154B 0%, #2C0630 100%);
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .close-modal {
            color: white;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            background: none;
            opacity: 0.8;
            transition: all 0.2s;
        }

        .close-modal:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .modal-body {
            padding: 25px;
            max-height: 75vh;
            overflow-y: auto;
        }

        /* Detail display in Modal */
        .detail-row {
            display: flex;
            margin-bottom: 12px;
            border-bottom: 1px dashed #eee;
            padding-bottom: 8px;
        }

        .detail-label {
            width: 140px;
            font-weight: 600;
            color: #555;
            flex-shrink: 0;
        }

        .detail-val {
            color: #333;
        }

        .img-preview {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px solid #ddd;
            max-height: 250px;
            object-fit: contain;
        }

        .form-group {
            margin-top: 20px;
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
            min-height: 100px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4A154B 0%, #2C0630 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            border: none;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-submit:hover {
            opacity: 0.95;
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

        <div class="welcome-card">
            <div class="welcome-text">
                <h2>Selamat Datang, <?= esc(session()->get('nama')) ?>!</h2>
                <p>Anda masuk sebagai Administrator. Anda memiliki akses penuh ke sistem pengaduan helpdesk.</p>
                <div class="badge-role">
                    <i class="fa-solid fa-user-shield"></i> <?= esc(session()->get('role')) ?>
                </div>
            </div>
            <div style="font-size: 70px; color: #4A154B; opacity: 0.15; padding-right: 15px;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Total Laporan</h3>
                    <div class="stat-number"><?= $totalLaporan ?></div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Laporan Baru</h3>
                    <div class="stat-number"><?= $laporanBaru ?></div>
                </div>
                <div class="stat-icon icon-yellow">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Selesai Diproses</h3>
                    <div class="stat-number"><?= $selesaiDiproses ?></div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Laporan Pengaduan -->
        <div class="content-panel" style="margin-bottom: 30px;">
            <div class="panel-header">
                <h3><i class="fa-solid fa-list-check"></i> Semua Daftar Pengaduan Masuk</h3>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pengadu (NPM)</th>
                            <th>Aduan / Kategori</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($laporanList)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: #888; padding: 40px;">
                                    <i class="fa-solid fa-inbox" style="font-size: 48px; opacity: 0.3; margin-bottom: 10px; display: block;"></i>
                                    Belum ada laporan pengaduan masuk saat ini.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($laporanList as $laporan): ?>
                                <tr>
                                    <td><?= esc(date('d M Y, H:i', strtotime($laporan['tanggal_lapor']))) ?> WIB</td>
                                    <td>
                                        <strong><?= esc($laporan['nama_pelapor']) ?></strong><br>
                                        <span style="font-size: 12px; color: #666;"><?= esc($laporan['npm'] ?? 'Bukan Mahasiswa') ?></span>
                                    </td>
                                    <td>
                                        <strong><?= esc($laporan['judul_laporan']) ?></strong><br>
                                        <span style="font-size: 12px; color: #666;"><?= esc($laporan['kategori']) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-prio-<?= esc($laporan['prioritas']) ?>">
                                            <?= esc($laporan['prioritas']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="<?= base_url('admin/laporan/update-status/' . $laporan['id_laporan']) ?>" method="post" style="display:inline;">
                                            <?= csrf_field() ?>
                                            <select name="status" class="badge badge-status-<?= esc($laporan['status']) ?>" onchange="this.form.submit()" style="border:1px solid rgba(0,0,0,0.12); outline:none; cursor:pointer; font-family:inherit; font-weight:600; padding:6px 10px; border-radius:20px;">
                                                <option value="menunggu" <?= $laporan['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                                <option value="diproses" <?= $laporan['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                                <option value="selesai" <?= $laporan['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                                <option value="ditolak" <?= $laporan['status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td style="text-align: center; white-space: nowrap; gap: 8px; display: flex; justify-content: center;">
                                        <button class="btn-action" onclick="openResponseModal(<?= esc(json_encode($laporan)) ?>, <?= esc(json_encode($tanggapanList[$laporan['id_laporan']])) ?>)">
                                            <i class="fa-solid fa-reply"></i> Tanggapi
                                        </button>
                                        <a href="<?= base_url('mahasiswa/laporan/tiket/' . $laporan['id_laporan']) ?>" class="btn-view-ticket" target="_blank">
                                            <i class="fa-solid fa-ticket"></i> Tiket
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Profile Panel -->
        <div class="content-panel" style="margin-bottom: 30px;">
            <div class="panel-header">
                <h3><i class="fa-solid fa-user-shield"></i> Informasi Profil Pengguna</h3>
            </div>
            <table class="user-details-table">
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td><?= esc(session()->get('nama')) ?></td>
                </tr>
                <tr>
                    <td class="label">Alamat Email</td>
                    <td><?= esc(session()->get('email')) ?></td>
                </tr>
                <tr>
                    <td class="label">Peran (Role)</td>
                    <td><span style="font-weight: 600; color: #4A154B; text-transform: uppercase;"><?= esc(session()->get('role')) ?></span></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Response Modal -->
    <div id="responseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fa-solid fa-reply-all"></i> Tanggapi & Update Status Pengaduan</h3>
                <button class="close-modal" onclick="closeResponseModal()">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Info Pengaduan -->
                <div class="detail-row">
                    <div class="detail-label">Pengadu</div>
                    <div class="detail-val" id="md_pengadu"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Judul Aduan</div>
                    <div class="detail-val" id="md_judul" style="font-weight: 600;"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Kategori</div>
                    <div class="detail-val" id="md_kategori"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Prioritas</div>
                    <div class="detail-val" id="md_prioritas"></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Deskripsi</div>
                    <div class="detail-val" id="md_deskripsi" style="white-space: pre-line;"></div>
                </div>
                <div class="detail-row" style="flex-direction: column; align-items: flex-start; border-bottom: none;">
                    <div class="detail-label" style="margin-bottom: 5px;">Foto Bukti</div>
                    <div class="detail-val" style="width: 100%; text-align: center;">
                        <a id="md_bukti_link" href="#" target="_blank">
                            <img id="md_bukti_img" src="" class="img-preview" alt="Bukti Foto">
                        </a>
                    </div>
                </div>

                <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

                <!-- Form Tanggapan -->
                <form id="tanggapanForm" method="post" action="">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="status">Update Status Laporan</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="menunggu">Menunggu (Belum diproses)</option>
                            <option value="diproses">Diproses (Sedang ditangani)</option>
                            <option value="selesai">Selesai (Tuntas ditanggapi)</option>
                            <option value="ditolak">Ditolak (Aduan tidak valid)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="isi_tanggapan">Tanggapan / Respon Resmi (Opsional)</label>
                        <textarea name="isi_tanggapan" id="isi_tanggapan" class="form-control" 
                                  placeholder="Opsional. Jika dikosongkan, sistem akan otomatis memberikan respon default berdasarkan status yang Anda pilih."></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-circle-check"></i> Simpan Tanggapan & Keluarkan Tiket
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal script -->
    <script>
        const modal = document.getElementById('responseModal');
        const form = document.getElementById('tanggapanForm');

        function openResponseModal(laporan, tanggapan) {
            document.getElementById('md_pengadu').innerText = `${laporan.nama_pelapor} (${laporan.npm || 'Bukan Mahasiswa'})`;
            document.getElementById('md_judul').innerText = laporan.judul_laporan;
            document.getElementById('md_kategori').innerText = laporan.kategori;
            document.getElementById('md_prioritas').innerText = laporan.prioritas.toUpperCase();
            document.getElementById('md_deskripsi').innerText = laporan.deskripsi;
            
            // Set image
            const img = document.getElementById('md_bukti_img');
            const link = document.getElementById('md_bukti_link');
            if(laporan.bukti_file) {
                const imgUrl = `<?= base_url('uploads/') ?>${laporan.bukti_file}`;
                img.src = imgUrl;
                link.href = imgUrl;
                img.style.display = 'inline-block';
            } else {
                img.style.display = 'none';
            }

            // Set Form action
            form.action = `<?= base_url('admin/laporan/tanggapi/') ?>${laporan.id_laporan}`;

            // Populate form if tanggapan already exists
            if (tanggapan) {
                document.getElementById('status').value = laporan.status;
                document.getElementById('isi_tanggapan').value = tanggapan.isi_tanggapan;
            } else {
                document.getElementById('status').value = laporan.status;
                document.getElementById('isi_tanggapan').value = '';
            }

            // Show modal
            modal.classList.add('active');
        }

        function closeResponseModal() {
            modal.classList.remove('active');
        }

        // Close when clicking outside modal-content
        window.onclick = function(event) {
            if (event.target == modal) {
                closeResponseModal();
            }
        }
    </script>

</body>
</html>
