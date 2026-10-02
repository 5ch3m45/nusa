<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsernamePasswordToStudents extends Migration
{
    public function up()
    {
        $this->forge->addColumn('students', [
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'guru_id',
            ],
            'password_hash' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'username',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('students', ['username', 'password_hash']);
    }
}
