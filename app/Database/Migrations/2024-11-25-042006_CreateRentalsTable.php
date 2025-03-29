<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRentalsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'transaction_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'unique'     => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'customer_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'shipping_cost' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'return_status' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'payment_status' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'payment_type' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'down_payment' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'payment_due' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'proof_of_payment' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'discount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rentals');
    }

    public function down()
    {
        $this->forge->dropTable('rentals');
    }
}