<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function dashboard()
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu sebagai Admin.');
        }

        return view('admin/dashboard');
    }
}
