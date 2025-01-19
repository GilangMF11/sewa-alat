<?php

namespace App\Models\Categories;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'created_at'];
    protected $createdField = 'created_at';
}
