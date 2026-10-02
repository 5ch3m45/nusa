<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBookAndMaterialToAssignments extends Migration
{
    public function up()
    {
        $this->forge->addColumn('assignments', [
            'book_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'guru_id',
            ],
            'material_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'book_id',
            ],
        ]);

        $this->forge->addForeignKey('book_id', 'books', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('material_id', 'materials', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('assignments', 'assignments_book_id_foreign');
        $this->forge->dropForeignKey('assignments', 'assignments_material_id_foreign');
        $this->forge->dropColumn('assignments', ['book_id', 'material_id']);
    }
}
