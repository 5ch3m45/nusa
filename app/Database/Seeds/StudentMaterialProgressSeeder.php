<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentMaterialProgressSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            // Andi Pratama (7A): selesai Bilangan Bulat (Bab 1), sedang mempelajari Aljabar Dasar (Bab 2)
            [
                'student_id'       => 2,
                'material_id'      => 2,
                'is_done'          => 1,
                'started_at'       => $now,
                'done_at'          => $now,
                'last_accessed_at' => $now,
                'score'            => 85.00,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'student_id'       => 2,
                'material_id'      => 3,
                'is_done'          => 0,
                'started_at'       => $now,
                'done_at'          => null,
                'last_accessed_at' => $now,
                'score'            => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // Citra Lestari (8A): selesai Zat dan Wujudnya (Bab 1)
            [
                'student_id'       => 4,
                'material_id'      => 4,
                'is_done'          => 1,
                'started_at'       => $now,
                'done_at'          => $now,
                'last_accessed_at' => $now,
                'score'            => 88.00,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            // Dewi Anggraini (8B): sedang mempelajari Kemerdekaan RI (Semester 2)
            [
                'student_id'       => 5,
                'material_id'      => 6,
                'is_done'          => 0,
                'started_at'       => $now,
                'done_at'          => null,
                'last_accessed_at' => $now,
                'score'            => null,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];

        $this->db->table('student_material_progress')->insertBatch($data);
    }
}
