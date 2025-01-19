<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('landing/v_landing');
    }

    public function detailProduct(): string
    {
        return view('product/v_product_detail');
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
}
