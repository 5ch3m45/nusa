<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookStoreAssignments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'book_store_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 200],
            'description' => ['type' => 'TEXT'],
            'subject'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'class'       => ['type' => 'VARCHAR', 'constraint' => 20],
            'semester'    => ['type' => 'INT', 'constraint' => 1],
            'due_date'    => ['type' => 'DATE'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('book_store_id', 'book_store', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('book_store_assignments');
    }

    public function down()
    {
        $this->forge->dropTable('book_store_assignments');
    }
}
