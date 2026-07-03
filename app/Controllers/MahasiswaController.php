<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MahasiswaController extends BaseController
{
    public function dashboard()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'mahasiswa') {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu sebagai Mahasiswa.');
        }

        return view('mahasiswa/dashboard');
    }
}
