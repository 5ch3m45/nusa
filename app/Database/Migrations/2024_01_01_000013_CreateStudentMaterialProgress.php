<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentMaterialProgress extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'student_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'material_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'is_done'          => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'started_at'       => ['type' => 'DATETIME', 'null' => true],
            'done_at'          => ['type' => 'DATETIME', 'null' => true],
            'last_accessed_at' => ['type' => 'DATETIME', 'null' => true],
            'score'            => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('student_id');
        $this->forge->addUniqueKey(['student_id', 'material_id']);
        $this->forge->addForeignKey('student_id', 'students', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('material_id', 'materials', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('student_material_progress');
    }

    public function down()
    {
        $this->forge->dropTable('student_material_progress');
    }
}
