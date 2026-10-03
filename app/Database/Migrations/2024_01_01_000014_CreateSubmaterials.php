<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubmaterials extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'material_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'type'        => ['type' => 'ENUM', 'constraint' => ['text', 'youtube', 'pdf', 'slides', 'mp3'], 'default' => 'text'],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 200],
            'content'     => ['type' => 'TEXT', 'null' => true],
            'url'         => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'sort_order'  => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('material_id');
        $this->forge->addForeignKey('material_id', 'materials', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('submaterials');
    }

    public function down()
    {
        $this->forge->dropTable('submaterials');
    }
}
