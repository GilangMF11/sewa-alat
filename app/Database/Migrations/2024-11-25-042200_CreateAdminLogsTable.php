<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminLogsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'admin_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'action' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('admin_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('admin_logs');
    }

    public function down()
    {
        $this->forge->dropTable('admin_logs');

    }
}
