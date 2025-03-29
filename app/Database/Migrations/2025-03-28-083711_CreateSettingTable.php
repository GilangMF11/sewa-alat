<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'background' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'facebook' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'instagram' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'twitter' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
