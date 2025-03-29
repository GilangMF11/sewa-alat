<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Halaman login
    public function login()
    {
        return view('Auth/v_login');
    }

    // Proses login
    public function loginProses()
    {
        $validation = \Config\Services::validation();
        $validationRules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($validationRules)) {
            return view('Auth/v_login', ['validation' => $this->validator]);
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Set sesi pengguna
                session()->set([
                    'user_id'    => $user['id'],
                    'name'       => $user['name'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true,
                ]);
                session()->setFlashdata('success', 'Login berhasil');
                return redirect()->to('/dashboard');
            } else {
                // Password salah
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');

            }
        } else {
            session()->setFlashdata('error', 'Password salah');
            return redirect()->to('/login');

        }
    }

    // Halaman registrasi
    public function register()
    {
        return view('Auth/v_register');
    }

    // Proses registrasi
    public function registerProses()
    {
        $validation = \Config\Services::validation();
        $validationRules = [
            'name'             => 'required|min_length[3]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]',
            'phone'            => 'permit_empty|numeric',
            'address'          => 'permit_empty|string',
        ];

        if (!$this->validate($validationRules)) {
            return view('Auth/v_register', ['validation' => $this->validator]);
        }

        // Ambil data dari form
        $userData = [
            'name'     => htmlspecialchars($this->request->getPost('name'), ENT_QUOTES, 'UTF-8'),
            'email'    => htmlspecialchars($this->request->getPost('email'), ENT_QUOTES, 'UTF-8'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => 'user', // Default role
            'phone'    => $this->request->getPost('phone'),
            'address'  => $this->request->getPost('address'),
        ];

        // Simpan ke database
        if ($this->userModel->insert($userData)) {
            session()->setFlashdata('success', 'Pendaftaran berhasil, silakan login.');
            return redirect()->to('/login');
        } else {
            return view('Auth/v_register', ['error' => 'Terjadi kesalahan, silakan coba lagi.']);
        }
    }

    // Proses logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}