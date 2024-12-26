<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data untuk pengguna
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'phone' => '08123456789',
                'address' => 'Jl. Raya Admin, No. 1',
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'phone' => '08129876543',
                'address' => 'Jl. Raya User, No. 2',
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
                'phone' => '08135678912',
                'address' => 'Jl. Raya User, No. 3',
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data ke tabel users
        $this->db->table('users')->insertBatch($users);

        // Output ke terminal
        echo "Seeder UserSeeder berhasil dijalankan!\n";
    }
}
