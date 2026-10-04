<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddScoreFeedbackToSubmissions extends Migration
{
    public function up()
    {
        $this->forge->addColumn('submissions', [
            'score'    => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true, 'after' => 'note'],
            'feedback' => ['type' => 'TEXT', 'null' => true, 'after' => 'score'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('submissions', ['score', 'feedback']);
    }
}
