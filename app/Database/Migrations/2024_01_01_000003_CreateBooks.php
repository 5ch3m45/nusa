<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'guru_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 200],
            'type'       => ['type' => 'ENUM', 'constraint' => ['link', 'pdf']],
            'url_or_path'=> ['type' => 'VARCHAR', 'constraint' => 500],
            'subject'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'class'      => ['type' => 'VARCHAR', 'constraint' => 20],
            'semester'   => ['type' => 'INT', 'constraint' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('guru_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}
