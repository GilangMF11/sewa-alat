<?php

namespace App\Controllers\Product;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Items\ItemModel;
use App\Models\Categories\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ItemModel();
        $this->categoryModel = new CategoryModel();
    }

    // Menampilkan daftar produk
    public function index()
    {
        $data = [
            'products' => $this->productModel->getItemsWithCategory(), // mengambil produk dengan kategori
            'categories' => $this->categoryModel->orderBy('name', 'asc')->findAll(),
        ];
        return view('Admin/product/v_product', $data);
    }

    // Menyimpan produk baru
    // Menyimpan produk baru atau update produk
public function store()
{
    $validation = \Config\Services::validation();

    // Validasi input
    if (!$this->validate([
        'name'        => 'required|min_length[3]|max_length[255]',
        'price'       => 'required|numeric',
        'description' => 'required',
        'stock'       => 'required|numeric',
        'category_id' => 'required',
        'image'       => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
    ])) {
        // Jika validasi gagal, kembali ke form dengan error
        return redirect()->to('/product')->withInput();
    }

    // Mendapatkan ID produk (jika ada)
    $id = $this->request->getPost('id');
    $image = $this->request->getFile('image');
    $imageName = null;  // Default jika tidak ada gambar baru

    // Jika ada gambar yang diunggah, simpan gambar baru
    if ($image && $image->isValid() && !$image->hasMoved()) {
        $imageName = $image->getRandomName();
        $image->move(WRITEPATH . 'uploads/products', $imageName);
    }

    // Menyiapkan data untuk disimpan, termasuk nama, harga, deskripsi, stok, dan kategori
    $data = [
        'name'        => $this->request->getPost('name'),
        'price'       => $this->request->getPost('price'),
        'description' => $this->request->getPost('description'),
        'stock'       => $this->request->getPost('stock'),
        'category_id' => $this->request->getPost('category_id'),
    ];

    // Jika ada gambar baru yang diunggah, tambahkan ke data
    if ($imageName) {
        $data['image'] = $imageName;
    } elseif ($id) {
        // Jika tidak ada gambar baru dan sedang mengupdate, ambil gambar lama dari database
        $existingProduct = $this->productModel->find($id);
        $data['image'] = $existingProduct['image'];  // Gunakan gambar lama
    }

    // Jika id ada, berarti kita sedang mengupdate produk
    if ($id) {
        // Update produk
        $this->productModel->update($id, $data);
        return redirect()->to('/product')->with('success', 'Produk berhasil diubah!');
    } else {
        // Insert produk baru
        $this->productModel->insert($data);
        return redirect()->to('/product')->with('success', 'Produk berhasil ditambahkan!');
    }
}



    // Menghapus produk
    public function delete($id)
    {
        // Mengambil data produk
        $product = $this->productModel->find($id);

        if ($product) {
            // Hapus file gambar
            if (file_exists(WRITEPATH . 'uploads/products' . $product['image'])) {
                unlink(WRITEPATH . 'uploads/products' . $product['image']);
            }

            // Hapus data produk
            $this->productModel->delete($id);

            // Redirect dengan pesan sukses
            return redirect()->to('/product')->with('success', 'Produk berhasil dihapus!');
        } else {
            return redirect()->to('/product')->with('error', 'Produk tidak ditemukan!');
        }
    }
}