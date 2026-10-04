<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAnswersLockedToSubmissions extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE submissions ADD COLUMN answers_locked TINYINT(1) NOT NULL DEFAULT 0 AFTER feedback");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE submissions DROP COLUMN answers_locked");
    }
}
