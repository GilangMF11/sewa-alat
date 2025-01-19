<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Users\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Inisialisasi model
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Ambil data pengguna dari database
        $users = $this->userModel->findAll();

        // Kirim data pengguna ke view
        return view('Admin/users/v_user', ['users' => $users]);
    }

    public function store()
    {
        // Validasi data input
        $validation = \Config\Services::validation();
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min_length[6]', // Validasi password
            'password_confirm' => 'matches[password]', // Validasi confirm password
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'role' => $this->request->getPost('role', 'user'), // Default role 'user'
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash password
        ];

        $userId = $this->request->getPost('id'); // Ambil ID pengguna jika ada (untuk update)

        if ($userId) {
            // Jika ada ID, lakukan update
            $this->userModel->update($userId, $userData);
            session()->setFlashdata('success', 'Pengguna berhasil diupdate');
        } else {
            // Jika tidak ada ID, lakukan create
            $this->userModel->save($userData);
            session()->setFlashdata('success', 'Pengguna berhasil ditambahkan');
        }

        // Redirect ke halaman pengguna setelah sukses
        return redirect()->to('/user');
    }

    // Fungsi untuk menghapus pengguna
    public function delete($id)
    {
        // Hapus data pengguna berdasarkan ID
        $this->userModel->delete($id);

        // Redirect dengan pesan berhasil
        session()->setFlashdata('success', 'Pengguna berhasil dihapus');
        return redirect()->to('/user');
    }
}
