<?php

namespace App\Services;

use App\Models\GradeModel;
use App\Models\StudentModel;

class UserService
{
    public function getUserProfile()
    {
        $studentId = session()->get('student_id');

        $student = $studentId ? (new StudentModel())->find($studentId) : null;
        $grades  = $studentId ? (new GradeModel())->getByStudent($studentId) : [];

        $scores  = array_column($grades, 'score');
        $average = $scores ? array_sum($scores) / count($scores) : 0;

        return [
            'name'  => $student['name'] ?? session()->get('student_name') ?? 'Siswa',
            'email' => '',
            'class' => $student['class'] ?? session()->get('student_class') ?? 1,
            'stats' => [
                'stars'    => (int) round($average),
                'missions' => count($grades),
                'average'  => (int) round($average),
            ],
            'latest_progress' => (new ProgressService())->getTheLatestProgressByUserId($studentId ?? 0),
        ];
    }

}
