<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanModel;
use App\Models\TanggapanModel;

class AdminController extends BaseController
{
    protected LaporanModel $laporanModel;
    protected TanggapanModel $tanggapanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
        $this->tanggapanModel = new TanggapanModel();
    }

    public function dashboard()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu sebagai Admin.');
        }

        // Fetch all complaints with reporter's NPM and email
        $laporanList = $this->laporanModel->select('laporan.*, users.npm, users.email')
                                          ->join('users', 'users.id_user = laporan.id_user', 'left')
                                          ->orderBy('laporan.tanggal_lapor', 'DESC')
                                          ->findAll();

        // Calculate statistics
        $totalLaporan = count($laporanList);
        $laporanBaru = $this->laporanModel->where('status', 'menunggu')->countAllResults();
        $selesaiDiproses = $this->laporanModel->where('status', 'selesai')->countAllResults();

        // Fetch tanggapan for each laporan to display in a modal if needed
        $tanggapanList = [];
        foreach ($laporanList as $lap) {
            $tang = $this->tanggapanModel->where('id_laporan', $lap['id_laporan'])->first();
            $tanggapanList[$lap['id_laporan']] = $tang ? $tang : null;
        }

        return view('admin/dashboard', [
            'laporanList'     => $laporanList,
            'tanggapanList'   => $tanggapanList,
            'totalLaporan'    => $totalLaporan,
            'laporanBaru'     => $laporanBaru,
            'selesaiDiproses' => $selesaiDiproses
        ]);
    }

    public function simpanTanggapan(int $id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu sebagai Admin.');
        }

        $validationRule = [
            'status' => [
                'rules' => 'required|in_list[menunggu,diproses,selesai,ditolak]',
                'errors' => [
                    'required' => 'Status laporan wajib dipilih.',
                    'in_list' => 'Status laporan tidak valid.'
                ]
            ],
            'isi_tanggapan' => [
                'rules' => 'permit_empty',
            ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $laporan = $this->laporanModel->find($id);
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
        }

        $isiTanggapan = $this->request->getPost('isi_tanggapan');
        if (empty($isiTanggapan)) {
            $status = $this->request->getPost('status');
            if ($status == 'diproses') {
                $isiTanggapan = "Laporan pengaduan sedang ditinjau dan ditangani oleh administrator.";
            } elseif ($status == 'selesai') {
                $isiTanggapan = "Laporan pengaduan telah diselesaikan secara tuntas.";
            } elseif ($status == 'ditolak') {
                $isiTanggapan = "Laporan pengaduan ditolak karena tidak memenuhi kriteria penanganan helpdesk.";
            } else {
                $isiTanggapan = "Laporan pengaduan dimasukkan ke dalam antrean menunggu.";
            }
        }

        // Save or update tanggapan
        $existingTanggapan = $this->tanggapanModel->where('id_laporan', $id)->first();

        $tanggapanData = [
            'id_laporan'        => $id,
            'id_admin'          => $session->get('id_user'),
            'isi_tanggapan'     => $isiTanggapan,
            'tanggal_tanggapan' => date('Y-m-d H:i:s')
        ];

        if ($existingTanggapan) {
            $tanggapanData['id_tanggapan'] = $existingTanggapan['id_tanggapan'];
        }

        $this->tanggapanModel->save($tanggapanData);

        // Update laporan status
        $this->laporanModel->update($id, [
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('admin/dashboard')->with('success', 'Tanggapan berhasil dikirim dan status tiket diperbarui.');
    }

    public function updateStatus(int $id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu sebagai Admin.');
        }

        $status = $this->request->getPost('status');
        if (!in_array($status, ['menunggu', 'diproses', 'selesai', 'ditolak'])) {
            return redirect()->back()->with('error', 'Status laporan tidak valid.');
        }

        $laporan = $this->laporanModel->find($id);
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
        }

        // Update status
        $this->laporanModel->update($id, [
            'status' => $status
        ]);

        // Add or update default tanggapan
        $existingTanggapan = $this->tanggapanModel->where('id_laporan', $id)->first();
        
        $defaultMessage = "";
        if ($status == 'diproses') {
            $defaultMessage = "Laporan pengaduan sedang ditinjau dan ditangani oleh administrator.";
        } elseif ($status == 'selesai') {
            $defaultMessage = "Laporan pengaduan telah diselesaikan secara tuntas.";
        } elseif ($status == 'ditolak') {
            $defaultMessage = "Laporan pengaduan ditolak karena tidak memenuhi kriteria penanganan helpdesk.";
        } else {
            $defaultMessage = "Laporan pengaduan dimasukkan ke dalam antrean menunggu.";
        }

        $tanggapanData = [
            'id_laporan'        => $id,
            'id_admin'          => $session->get('id_user'),
            'isi_tanggapan'     => $defaultMessage,
            'tanggal_tanggapan' => date('Y-m-d H:i:s')
        ];

        if ($existingTanggapan) {
            // Update the existing response with updated date/status message if it was a default one
            $tanggapanData['id_tanggapan'] = $existingTanggapan['id_tanggapan'];
        }

        $this->tanggapanModel->save($tanggapanData);

        return redirect()->to('admin/dashboard')->with('success', 'Status aduan berhasil diubah menjadi "' . $status . '".');
    }
}
