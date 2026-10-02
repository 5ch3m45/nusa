<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookStore extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 200],
            'type'        => ['type' => 'ENUM', 'constraint' => ['link', 'pdf']],
            'url_or_path' => ['type' => 'VARCHAR', 'constraint' => 500],
            'subject'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'class'       => ['type' => 'VARCHAR', 'constraint' => 20],
            'semester'    => ['type' => 'INT', 'constraint' => 1],
            'description' => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('book_store');
    }

    public function down()
    {
        $this->forge->dropTable('book_store');
    }
}
