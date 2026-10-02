<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBookIdToMaterials extends Migration
{
    public function up()
    {
        $this->forge->addColumn('materials', [
            'book_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'guru_id',
            ],
        ]);

        $this->forge->addForeignKey('book_id', 'books', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('materials', 'materials_book_id_foreign');
        $this->forge->dropColumn('materials', 'book_id');
    }
}
