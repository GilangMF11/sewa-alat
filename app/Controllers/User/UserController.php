<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Users\UserModel;
use App\Models\Rentals\RentalModel;
use App\Models\Rentals\RentalItemModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $rentalModel;
    protected $rentalItemModel;


    public function __construct()
    {
        // Inisialisasi model
        $this->userModel = new UserModel();
        $this->rentalModel = new RentalModel();
        $this->rentalItemModel = new RentalItemModel();
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
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($userId);
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
    
        return redirect()->to('/profile');
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

    // Transaction User
    public function transaction() {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $rentals = $this->rentalModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();

        return view('Users/transactions/v_user_transactions', [
            'rentals' => $rentals
        ]);
    }

    public function transactionDetail($rentalId)
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        // Ambil transaksi berdasarkan ID DESC
        $rental = $this->rentalModel->find($rentalId);

        if (!$rental || $rental['user_id'] !== $userId) {
            return redirect()->to('/user/transactions')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Ambil item sewa berdasarkan rental_id
        $rentalItems = $this->rentalItemModel->getItemsByRental($rentalId);

        return view('Users/transactions/v_user_transactions_detail', [
            'rental' => $rental,
            'rentalItems' => $rentalItems
        ]);
    }

    

    public function print($id)
    {
        $settings = $this->setting;
        $rental = $this->rentalModel->find($id);
        $items = $this->rentalItemModel
                    ->select('rental_items.*, items.name as item_name')
                    ->join('items', 'items.id = rental_items.item_id')
                    ->where('rental_items.rental_id', $id)
                    ->findAll();

        if (!$rental) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan.');
        }

        return view('Admin/rental-status/v_rental_print_struk', [
            'rental' => $rental,
            'items' => $items,
            'setting' => $settings
        ]);
    }


}