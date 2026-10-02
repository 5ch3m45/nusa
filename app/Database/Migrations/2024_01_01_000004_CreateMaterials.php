<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaterials extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'guru_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 200],
            'subject'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'chapter'    => ['type' => 'VARCHAR', 'constraint' => 50],
            'semester'   => ['type' => 'INT', 'constraint' => 1],
            'class'      => ['type' => 'VARCHAR', 'constraint' => 20],
            'content'    => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('guru_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('materials');
    }

    public function down()
    {
        $this->forge->dropTable('materials');
    }
}
