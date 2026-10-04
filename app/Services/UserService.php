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

        // Bintang = jumlah submission yang sudah di-upload dan dinilai guru
        $starsCount = 0;
        $averageScore = 0;
        $missionsLeft = 0;
        if ($studentId) {
            $db = \Config\Database::connect();

            $starsCount = $db->table('submissions')
                ->where('student_id', $studentId)
                ->where('score IS NOT NULL')
                ->countAllResults();

            $scoresRows = $db->table('submissions')
                ->select('score')
                ->where('student_id', $studentId)
                ->where('score IS NOT NULL')
                ->get()
                ->getResultArray();
            $scoreVals = array_column($scoresRows, 'score');
            $averageScore = $scoreVals ? round(array_sum($scoreVals) / count($scoreVals), 1) : 0;

            // Misi = tugas yang belum dikerjakan (belum ada submission)
            $studentClass = $student['class'] ?? session()->get('student_class');
            if ($studentClass) {
                $submittedIds = $db->table('submissions')
                    ->select('assignment_id')
                    ->where('student_id', $studentId)
                    ->get()
                    ->getResultArray();
                $submittedIds = array_column($submittedIds, 'assignment_id');

                $builder = $db->table('assignments')->where('class', $studentClass);
                if (!empty($submittedIds)) {
                    $builder->whereNotIn('id', $submittedIds);
                }
                $missionsLeft = $builder->countAllResults();
            }
        }

        return [
            'name'  => $student['name'] ?? session()->get('student_name') ?? 'Siswa',
            'email' => '',
            'class' => $student['class'] ?? session()->get('student_class') ?? 1,
            'stats' => [
                'stars'    => $starsCount,
                'missions' => $missionsLeft,
                'average'  => $averageScore,
            ],
            'latest_progress' => (new ProgressService())->getTheLatestProgressByUserId($studentId ?? 0),
        ];
    }

}
