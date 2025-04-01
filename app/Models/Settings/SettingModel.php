<?php

namespace App\Models\Settings;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'id',
        'name_web',
        'phone',
        'logo',
        'background',
        'facebook',
        'instagram',
        'twitter',
    ];
}
