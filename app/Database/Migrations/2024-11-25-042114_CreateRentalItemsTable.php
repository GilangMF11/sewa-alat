<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRentalItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'rental_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'item_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('rental_id', 'rentals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('item_id', 'items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rental_items');
    }

    public function down()
    {
        $this->forge->dropTable('rental_items');
    }
}
