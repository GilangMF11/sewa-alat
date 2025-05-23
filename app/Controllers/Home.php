<?php

namespace App\Controllers;
use App\Models\Items\ItemModel;
use App\Models\Settings\SettingModel;

class Home extends BaseController
{
    protected $itemModel;
    protected $settingModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->settingModel = new SettingModel();
    }
    public function index()
    {
        $data = [
            'products' => $this->itemModel->orderBy('name', 'asc')->findAll(),
            'setting' => $this->settingModel->first()
        ];
        return view('landing/v_landing', $data);
    }

    public function detailProduct($id)
    {
        // Mengambil data produk berdasarkan ID
        $product = $this->itemModel->find($id);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan');
        }

        // Mengirim data produk ke tampilan detail
        $data = [
            'product' => $product
        ];

        return view('product/v_product_detail', $data);
    }

    public function allProducts()
    {
        // Ambil kata kunci pencarian dari form
        $searchKeyword = $this->request->getVar('search');
    
        // Jika ada kata kunci pencarian, filter data produk berdasarkan nama atau deskripsi
        if ($searchKeyword) {
            $products = $this->itemModel->like('name', $searchKeyword)
                                        ->orLike('description', $searchKeyword)
                                        ->findAll();
        } else {
            $products = $this->itemModel->findAll();
        }
    
        // Kirimkan data produk dan kata kunci pencarian ke tampilan
        $data = [
            'products' => $products,
            'search' => $searchKeyword
        ];
    
        return view('product/v_product_all', $data);
    }
    

    public function showImage($filename)
    {
        $path = WRITEPATH . 'uploads/products/' . $filename;

        if (!is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($filename);
        }

        $mime = mime_content_type($path);
        header("Content-Type: " . $mime);
        readfile($path);
        exit;
    }

    public function showImageHome($filename)
    {
        $path = FCPATH . 'uploads/background/' . $filename;

        // if (!is_file($path)) {
        //     // Bisa redirect ke gambar default atau tampilkan error image
        //     $path = WRITEPATH . 'uploads/background/default.jpg';
        //     if (!is_file($path)) {
        //         throw new \CodeIgniter\Exceptions\PageNotFoundException($filename);
        //     }
        // }

        if (!is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($filename);
        }

        $mime = mime_content_type($path);
        header("Content-Type: " . $mime);
        header("Content-Length: " . filesize($path));
        ob_clean(); flush(); // Hentikan output buffer kalau ada
        readfile($path);
        exit;
    }

    public function showImageLogo($filename)
    {
        $path = WRITEPATH . 'uploads/logo/' . $filename;

        if (!is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($filename);
        }

        $mime = mime_content_type($path);
        header("Content-Type: " . $mime);
        readfile($path);
        exit;
    }

    public function showImageProofOfPayments($filename)
    {
        $path = WRITEPATH . 'uploads/payments/' . $filename;

        if (!is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($filename);
        }

        $mime = mime_content_type($path);
        header("Content-Type: " . $mime);
        readfile($path);
        exit;
    }
}