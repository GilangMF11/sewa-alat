<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Categories\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {


        $data['categories'] = $this->categoryModel->orderBy('name', 'asc')->findAll();
        return view('Admin/category/v_category', $data);
    }

    public function store()
    {
        $id = $this->request->getPost('id');
        
        // Data 

        $data = [
            'name' => $this->request->getPost('name'),
        ];

        // Jika id belum ada maka akan menambahkan data dan jika id sudah ada maka akan update
        if ($id) {
            $this->categoryModel->update($id, $data);
            return redirect()->to('/category')->with('success', 'Data Berhasil Diubah');
        } else {
            $this->categoryModel->insert($data);
            return redirect()->to('/category')->with('success', 'Data Berhasil Ditambahkan');
        }
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to('/category')->with('success', 'Data Berhasil Dihapus');
    }
}
