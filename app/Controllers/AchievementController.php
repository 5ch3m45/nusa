<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\UserService;
use CodeIgniter\HTTP\ResponseInterface;

class AchievementController extends BaseController
{
    public function index()
    {
        $studentId = session()->get('student_id');
        $submissions = \Config\Database::connect()->table('submissions')
            ->select('submissions.id, submissions.score, submissions.updated_at, assignments.title as assignment_title, assignments.subject, books.title as book_title, materials.title as material_title')
            ->join('assignments', 'assignments.id = submissions.assignment_id')
            ->join('books', 'books.id = assignments.book_id', 'left')
            ->join('materials', 'materials.id = assignments.material_id', 'left')
            ->where('submissions.student_id', $studentId)
            ->where('submissions.score IS NOT NULL')
            ->groupStart()
                ->where('assignments.type', 'upload')
                ->orWhere('submissions.answers_locked', 1)
                ->orWhere('assignments.due_date <', date('Y-m-d'))
            ->groupEnd()
            ->orderBy('submissions.updated_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('murid/achievement', [
            'profile'      => (new UserService())->getUserProfile(),
            'totalStars'   => count($submissions),
            'certificates' => $submissions,
            'averageScore' => count($submissions) ? round(array_sum(array_column($submissions, 'score')) / count($submissions), 1) : 0,
        ]);
    }
}
