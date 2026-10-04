<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizSupport extends Migration
{
    public function up()
    {
        // Jenis tugas: upload / quiz
        $this->db->query("ALTER TABLE assignments ADD COLUMN type ENUM('upload','quiz') NOT NULL DEFAULT 'upload' AFTER semester");

        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'assignment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'question'      => ['type' => 'TEXT'],
            'option_a'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'option_b'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'option_c'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'option_d'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'correct'       => ['type' => 'ENUM', 'constraint' => ['a', 'b', 'c', 'd']],
            'order'         => ['type' => 'INT', 'constraint' => 5, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('assignment_id', 'assignments', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('assignment_questions');

        // Submission bisa tanpa file (kuis) dan simpan jawaban
        $this->db->query("ALTER TABLE submissions MODIFY file_path VARCHAR(255) NULL");
        $this->db->query("ALTER TABLE submissions MODIFY original_name VARCHAR(255) NULL");
        $this->db->query("ALTER TABLE submissions ADD COLUMN answer TEXT NULL AFTER note");
    }

    public function down()
    {
        $this->forge->dropTable('assignment_questions');
        $this->db->query("ALTER TABLE assignments DROP COLUMN type");
        $this->db->query("ALTER TABLE submissions DROP COLUMN answer");
        $this->db->query("ALTER TABLE submissions MODIFY file_path VARCHAR(255) NOT NULL");
    }
}
