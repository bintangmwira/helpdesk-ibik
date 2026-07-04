<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in')) {
            $role = session()->get('role');
            if ($role === 'admin') {
                return redirect()->to('admin/dashboard');
            } elseif ($role === 'mahasiswa') {
                return redirect()->to('mahasiswa/dashboard');
            }
        }

        return view('auth/Login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');


        if (empty($email) || empty($password)) {
            $session->setFlashdata('error', 'Email dan password harus diisi.');
            return redirect()->back()->withInput();
        }

        $user = $model->where('email', $email)->first();

        if ($user) {

            if (password_verify($password, $user['password'])) {
                $session->set([
                    'id_user'   => $user['id_user'],
                    'npm'       => $user['npm'],
                    'nama'      => $user['nama'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                ]);

                if ($user['role'] === 'admin') {
                    return redirect()->to('admin/dashboard');
                } else {
                    return redirect()->to('mahasiswa/dashboard');
                }
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'Email tidak terdaftar.');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
