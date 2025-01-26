<?php

namespace App\Models\Users;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'phone', 'address', 'role', 'created_at'];
    protected $createdField = 'created_at';

    
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
