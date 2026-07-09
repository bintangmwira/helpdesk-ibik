<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanModel;
use App\Models\TanggapanModel;

class MahasiswaController extends BaseController
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
        if (!$session->get('logged_in') || $session->get('role') !== 'mahasiswa') {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu sebagai Mahasiswa.');
        }

        $userId = $session->get('id_user');

        // Fetch student's complaints
        $laporanList = $this->laporanModel->where('id_user', $userId)->orderBy('tanggal_lapor', 'DESC')->findAll();

        // Calculate statistics
        $totalAduan = count($laporanList);
        $totalDiproses = $this->laporanModel->where('id_user', $userId)->where('status', 'diproses')->countAllResults();
        $totalSelesai = $this->laporanModel->where('id_user', $userId)->where('status', 'selesai')->countAllResults();

        return view('mahasiswa/dashboard', [
            'laporanList' => $laporanList,
            'totalAduan' => $totalAduan,
            'totalDiproses' => $totalDiproses,
            'totalSelesai' => $totalSelesai
        ]);
    }

    public function simpanLaporan()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'mahasiswa') {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu.');
        }

        $validationRule = [
            'nama_pelapor' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama pelapor wajib diisi.',
                    'max_length' => 'Nama pelapor maksimal 100 karakter.'
                ]
            ],
            'judul_laporan' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required' => 'Judul aduan wajib diisi.',
                    'max_length' => 'Judul aduan maksimal 150 karakter.'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori aduan wajib dipilih.'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi aduan wajib diisi.'
                ]
            ],
            'prioritas' => [
                'rules' => 'required|in_list[rendah,sedang,tinggi]',
                'errors' => [
                    'required' => 'Prioritas aduan wajib dipilih.',
                    'in_list' => 'Prioritas aduan tidak valid.'
                ]
            ],
            'bukti_file' => [
                'rules' => 'uploaded[bukti_file]|is_image[bukti_file]|mime_in[bukti_file,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[bukti_file,4096]',
                'errors' => [
                    'uploaded' => 'Foto bukti aduan wajib diunggah.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in' => 'Format file harus JPG/JPEG/PNG/GIF/WEBP.',
                    'max_size' => 'Ukuran file maksimal 4MB.'
                ]
            ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $file = $this->request->getFile('bukti_file');
        $fileName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $fileName);
        }

        $this->laporanModel->save([
            'id_user'       => $session->get('id_user'),
            'nama_pelapor'  => $this->request->getPost('nama_pelapor'),
            'judul_laporan' => $this->request->getPost('judul_laporan'),
            'kategori'      => $this->request->getPost('kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'prioritas'     => $this->request->getPost('prioritas'),
            'bukti_file'    => $fileName,
            'status'        => 'menunggu'
        ]);

        return redirect()->to('mahasiswa/dashboard')->with('success', 'Pengaduan berhasil dikirim! Silakan pantau status aduan Anda.');
    }

    public function detailTiket(int $id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu.');
        }

        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Tiket tidak ditemukan.");
        }

        // Verify that this complaint belongs to the logged-in student (unless they are admin)
        if ($session->get('role') !== 'admin' && $laporan['id_user'] != $session->get('id_user')) {
            return redirect()->to('mahasiswa/dashboard')->with('error', 'Anda tidak memiliki akses ke tiket ini.');
        }

        // Fetch tanggapan / admin response if it exists
        $tanggapan = $this->tanggapanModel->select('tanggapan.*, users.nama as nama_admin')
                                          ->join('users', 'users.id_user = tanggapan.id_admin', 'left')
                                          ->where('id_laporan', $id)
                                          ->first();

        return view('mahasiswa/tiket', [
            'laporan'   => $laporan,
            'tanggapan' => $tanggapan
        ]);
    }
}
