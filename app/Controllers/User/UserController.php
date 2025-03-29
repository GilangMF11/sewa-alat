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
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        $userId = $this->request->getPost('id'); // Ambil ID pengguna jika ada (untuk update)

        // Cek jika password baru ada
        $newPassword = $this->request->getPost('password');
        if ($newPassword) {
            // Validasi password
            $passwordConfirm = $this->request->getPost('password_confirm');
            if ($newPassword !== $passwordConfirm) {
                return redirect()->back()->withInput()->with('errors', ['Password confirmation does not match']);
            }

            // Hash password baru
            $userData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        if ($userId) {
            // Jika ada ID, lakukan update
            $this->userModel->update($userId, $userData);
            return redirect()->to('/user')->with('success', 'Pengguna berhasil diperbarui');
        } else {
            // Jika tidak ada ID, lakukan create
            $this->userModel->save($userData);
            return redirect()->to('/user')->with('success', 'Pengguna berhasil ditambahkan');
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
        //session()->setFlashdata('success', 'Pengguna berhasil dihapus');
        return redirect()->to('/user')->with('success', 'Pengguna berhasil dihapus');
    }

    
    // Menampilkan profil pengguna
    public function profile()
    {
        // Pastikan ada ID pengguna di session
        $userId = session()->get('user_id');
         if (!$userId) {
            return redirect()->to('/login'); // Redirect ke halaman login jika belum login
        }
    
        // Ambil data pengguna berdasarkan ID
        $user = $this->userModel->find($userId);
    
        // Kirim data pengguna ke view
        return view('Users/profile/v_user_profile', ['user' => $user]);
    }
    
        // Fungsi untuk memperbarui profil pengguna
    public function updateProfile()
    {
        // Pastikan ada ID pengguna di session
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }
    
        // Validasi data input
        $validation = \Config\Services::validation();
            $rules = [
                'name' => 'required|min_length[3]',
                'email' => 'required|valid_email',
                'phone' => 'required',
                'address' => 'required',
            ];
    
            if (!$this->validate($rules)) {
                // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
    
            // Ambil data dari form
            $userData = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
            ];
    
        // Update data pengguna berdasarkan ID
        $this->userModel->update($userId, $userData);
        session()->setFlashdata('success', 'Profil berhasil diperbarui');
    
        return redirect()->to('/user/profile');
    }

    public function search()
    {
        $query = $this->request->getGet('query');

        if ($query) {
            $users = $this->userModel->like('name', $query)->findAll();
        } else {
            $users = $this->userModel->findAll();
        }

        return $this->response->setJSON([]);
    }
    
}