<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GradeSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $score = 70;
        for ($assignmentId = 1; $assignmentId <= 3; $assignmentId++) {
            for ($studentId = 1; $studentId <= 5; $studentId++) {
                $data[] = [
                    'assignment_id' => $assignmentId,
                    'student_id'    => $studentId,
                    'score'         => $score + (($assignmentId + $studentId) % 31),
                    'feedback'      => 'Bagus, pertahankan!',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ];
            }
        }

        $this->db->table('grades')->insertBatch($data);
    }
}
