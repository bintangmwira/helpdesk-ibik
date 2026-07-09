<?php
/**
 * @var array $laporan
 * @var array|null $tanggapan
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Aduan #<?= esc($laporan['id_laporan']) ?> - Helpdesk IBIK</title>

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
            padding: 40px 20px;
        }

        .ticket-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .actions-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-back {
            background: white;
            color: #555;
            border: 1px solid #ddd;
        }

        .btn-back:hover {
            background: #f8f9fa;
            color: #333;
        }

        .btn-print {
            background: linear-gradient(135deg, #4A154B 0%, #2C0630 100%);
            color: white;
        }

        .btn-print:hover {
            opacity: 0.95;
            box-shadow: 0 4px 10px rgba(74, 21, 75, 0.15);
        }

        /* Ticket Box Design */
        .ticket-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid rgba(74, 21, 75, 0.08);
            position: relative;
        }

        /* Header like an envelope tear-off */
        .ticket-header {
            background: linear-gradient(135deg, #4A154B 0%, #2C0630 100%);
            color: white;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .ticket-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ticket-logo h2 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .ticket-id {
            background: rgba(255, 255, 255, 0.15);
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            border: 1px solid rgba(255, 255, 255, 0.2);
            letter-spacing: 1px;
        }

        /* Ticket Body */
        .ticket-body {
            padding: 35px;
        }

        .ticket-section-title {
            color: #4A154B;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .grid-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 40px;
            margin-bottom: 30px;
        }

        @media (max-width: 576px) {
            .grid-info {
                grid-template-columns: 1fr;
            }
        }

        .info-item label {
            display: block;
            font-size: 13px;
            color: #888;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .info-item span {
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
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

        .ticket-divider {
            border: none;
            border-top: 2px dashed #ddd;
            margin: 30px 0;
            position: relative;
        }

        /* Tear-out dots on side of ticket */
        .ticket-divider::before, .ticket-divider::after {
            content: '';
            position: absolute;
            top: -10px;
            width: 20px;
            height: 20px;
            background: #f5f5f9;
            border-radius: 50%;
            border: 1px solid rgba(74, 21, 75, 0.08);
        }

        .ticket-divider::before {
            left: -46px;
            box-shadow: inset -3px 0 3px rgba(0,0,0,0.02);
        }

        .ticket-divider::after {
            right: -46px;
            box-shadow: inset 3px 0 3px rgba(0,0,0,0.02);
        }

        /* Complaint detail display */
        .complaint-description {
            background: #fdfdfd;
            border: 1px solid #f0f0f2;
            padding: 20px;
            border-radius: 12px;
            font-size: 15px;
            line-height: 1.6;
            color: #444;
            margin-bottom: 25px;
            white-space: pre-wrap;
        }

        .bukti-image-container {
            text-align: center;
            background: #fafafa;
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 10px;
        }

        .bukti-image-container img {
            max-width: 100%;
            max-height: 350px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        /* Admin Response Panel */
        .response-panel {
            background-color: #f7f3fb;
            border-left: 5px solid #4A154B;
            border-radius: 0 12px 12px 0;
            padding: 25px;
            margin-top: 10px;
        }

        .response-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 13px;
            color: #666;
        }

        .response-text {
            font-size: 15px;
            line-height: 1.6;
            color: #333;
            white-space: pre-wrap;
        }

        .waiting-response {
            background-color: #fcfcfc;
            border: 1px dashed #ddd;
            text-align: center;
            padding: 30px;
            border-radius: 12px;
            color: #888;
            font-size: 14px;
        }

        /* Print Specific Styles */
        @media print {
            body {
                background: white;
                padding: 0;
            }

            .actions-panel, .btn-back, .btn-print, nav {
                display: none !important;
            }

            .ticket-card {
                box-shadow: none;
                border: 1px solid #333;
            }

            .ticket-header {
                background: #4A154B !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .response-panel {
                background-color: #f7f3fb !important;
                border-left: 5px solid #4A154B !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .ticket-divider::before, .ticket-divider::after {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="ticket-container">
        <!-- Actions -->
        <div class="actions-panel">
            <?php if(session()->get('role') === 'admin'): ?>
                <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard Admin
                </a>
            <?php else: ?>
                <a href="<?= base_url('mahasiswa/dashboard') ?>" class="btn btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard Saya
                </a>
            <?php endif; ?>
            
            <button onclick="window.print()" class="btn btn-print">
                <i class="fa-solid fa-print"></i> Cetak Tiket Aduan
            </button>
        </div>

        <!-- Ticket Card -->
        <div class="ticket-card">
            
            <!-- Ticket Header -->
            <div class="ticket-header">
                <div class="ticket-logo">
                    <i class="fa-solid fa-ticket-simple" style="font-size: 26px;"></i>
                    <h2>TIKET PENGADUAN</h2>
                </div>
                <div class="ticket-id">
                    TKT-#<?= esc(str_pad($laporan['id_laporan'], 6, '0', STR_PAD_LEFT)) ?>
                </div>
            </div>

            <!-- Ticket Body -->
            <div class="ticket-body">

                <!-- Section: Informasi Pelapor -->
                <div class="ticket-section-title">
                    <i class="fa-solid fa-user-tag"></i> Informasi Pelapor & Tiket
                </div>

                <div class="grid-info">
                    <div class="info-item">
                        <label>Nama Pelapor</label>
                        <span><?= esc($laporan['nama_pelapor']) ?></span>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Masuk</label>
                        <span><?= esc(date('d F Y, H:i', strtotime($laporan['tanggal_lapor']))) ?> WIB</span>
                    </div>
                    <div class="info-item">
                        <label>Kategori Aduan</label>
                        <span><?= esc($laporan['kategori']) ?></span>
                    </div>
                    <div class="info-item">
                        <label>Tingkat Prioritas</label>
                        <div>
                            <span class="badge badge-prio-<?= esc($laporan['prioritas']) ?>">
                                <?= esc($laporan['prioritas']) ?>
                            </span>
                        </div>
                    </div>
                    <div class="info-item">
                        <label>Status Tiket</label>
                        <div>
                            <span class="badge badge-status-<?= esc($laporan['status']) ?>">
                                <?= esc($laporan['status']) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="ticket-divider"></div>

                <!-- Section: Detail Aduan -->
                <div class="ticket-section-title">
                    <i class="fa-solid fa-circle-info"></i> Deskripsi Pengaduan & Bukti
                </div>

                <div class="info-item" style="margin-bottom: 10px;">
                    <label>Subjek Aduan</label>
                    <span style="font-size: 16px; color: #4A154B; display: block; margin-bottom: 10px;"><?= esc($laporan['judul_laporan']) ?></span>
                </div>

                <div class="info-item">
                    <label>Deskripsi Kendala</label>
                    <div class="complaint-description"><?= esc($laporan['deskripsi']) ?></div>
                </div>

                <?php if ($laporan['bukti_file']): ?>
                    <div class="info-item">
                        <label>Foto Bukti Pendukung</label>
                        <div class="bukti-image-container">
                            <img src="<?= base_url('uploads/' . $laporan['bukti_file']) ?>" alt="Foto Bukti Aduan">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="ticket-divider"></div>

                <!-- Section: Respon Admin -->
                <div class="ticket-section-title">
                    <i class="fa-solid fa-reply-all"></i> Tanggapan Resmi Administrator
                </div>

                <?php if ($tanggapan): ?>
                    <div class="response-panel">
                        <div class="response-meta">
                            <span><i class="fa-solid fa-user-tie"></i> Ditanggapi oleh: <strong><?= esc($tanggapan['nama_admin']) ?></strong></span>
                            <span><?= esc(date('d F Y, H:i', strtotime($tanggapan['tanggal_tanggapan']))) ?> WIB</span>
                        </div>
                        <div class="response-text"><?= esc($tanggapan['isi_tanggapan']) ?></div>
                    </div>
                <?php else: ?>
                    <div class="waiting-response">
                        <i class="fa-solid fa-clock-rotate-left" style="font-size: 28px; display: block; margin-bottom: 10px; opacity: 0.6;"></i>
                        Belum ada tanggapan untuk tiket aduan ini. Petugas helpdesk akan memproses laporan Anda secepatnya.
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>

</body>
</html>
