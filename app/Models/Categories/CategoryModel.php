<?php

namespace App\Models\Categories;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'created_at'];
    protected $useTimestamps = false;
}
