<?php

namespace App\Models\Logs;

use CodeIgniter\Model;

class AdminLogModel extends Model
{
    protected $table = 'admin_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['admin_id', 'action', 'created_at'];
    protected $useTimestamps = false;

    /**
     * Fungsi untuk mendapatkan log berdasarkan admin
     */
    public function getLogsByAdmin($adminId)
    {
        return $this->where('admin_id', $adminId)->findAll();
    }
}
