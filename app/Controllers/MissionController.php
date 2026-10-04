<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AssignmentModel;
use App\Models\BookModel;
use App\Models\MaterialModel;
use App\Models\StudentMaterialProgressModel;
use App\Models\SubmissionModel;
use App\Models\SubmaterialModel;
use App\Services\UserService;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class MissionController extends BaseController
{
    public function index()
    {
        return $this->renderSemester(1);
    }

    public function semester($semester)
    {
        return $this->renderSemester((int) $semester);
    }

    public function detail($materialId)
    {
        return $this->renderDetail((int) $materialId, 'material');
    }

    public function book($materialId)
    {
        return $this->renderDetail((int) $materialId, 'book');
    }

    public function material($materialId)
    {
        return $this->renderDetail((int) $materialId, 'material');
    }

    public function assignment($materialId)
    {
        return $this->renderDetail((int) $materialId, 'assignment');
    }

    public function complete($materialId)
    {
        $materialId = (int) $materialId;
        $this->findStudentMaterial($materialId);

        (new StudentMaterialProgressModel())->complete(session()->get('student_id'), $materialId);

        return redirect()->to('/murid/missions/' . $materialId . '/material');
    }

    public function submitAssignment($assignmentId)
    {
        $assignmentId = (int) $assignmentId;
        $assignment = (new AssignmentModel())->find($assignmentId);
        if (!$assignment) {
            throw PageNotFoundException::forPageNotFound();
        }

        $studentId = session()->get('student_id');
        $submissionModel = new SubmissionModel();

        $file = $this->request->getFile('file');
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('error', 'File tugas wajib diunggah.');
        }

        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads', $newName);

        $existing = $submissionModel->getByAssignmentAndStudent($assignmentId, $studentId);
        $data = [
            'assignment_id' => $assignmentId,
            'student_id'    => $studentId,
            'file_path'     => 'uploads/' . $newName,
            'original_name' => $file->getClientName(),
            'note'          => $this->request->getPost('note'),
        ];

        if ($existing) {
            $submissionModel->update($existing['id'], $data);
        } else {
            $submissionModel->insert($data);
        }

        return redirect()->to('/murid/missions/' . $assignment['material_id'] . '/assignment')
            ->with('success', 'Tugas berhasil diunggah.');
    }

    public function certificate($submissionId)
    {
        $submissionId = (int) $submissionId;
        $studentId = session()->get('student_id');

        $data = \Config\Database::connect()->table('submissions')
            ->select('submissions.*, submissions.updated_at as graded_at, students.name as student_name, students.class as student_class, assignments.title as assignment_title, assignments.subject, assignments.class as assignment_class, users.name as guru_name, books.title as book_title, materials.title as material_title')
            ->join('assignments', 'assignments.id = submissions.assignment_id')
            ->join('students', 'students.id = submissions.student_id')
            ->join('users', 'users.id = assignments.guru_id', 'left')
            ->join('books', 'books.id = assignments.book_id', 'left')
            ->join('materials', 'materials.id = assignments.material_id', 'left')
            ->where('submissions.id', $submissionId)
            ->where('submissions.student_id', $studentId)
            ->get()
            ->getRowArray();

        if (!$data || $data['score'] === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $html = view('murid/certificate', ['submission' => $data]);

        $dompdf = new \Dompdf\Dompdf(['isRemoteEnabled' => true]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Piagam-' . preg_replace('/[^a-zA-Z0-9]/', '-', $data['assignment_title']) . '.pdf', ['Attachment' => true]);
        exit;
    }

    private function renderSemester(int $semester)
    {
        $user = (new UserService())->getUserProfile();
        $materials = (new MaterialModel())->getByClassAndSemester(
            (string) ($user['class'] ?? ''),
            $semester,
            session()->get('student_id')
        );

        return view('murid/mission', [
            'page' => 'missions',
            'materials' => $materials,
            'profile' => $user,
            'semester' => $semester,
        ]);
    }

    private function renderDetail(int $materialId, string $tab)
    {
        $material = $this->findStudentMaterial($materialId);

        $data = [
            'page'       => 'missions',
            'material'   => $material,
            'book'       => $material['book_id'] ? (new BookModel())->find($material['book_id']) : null,
            'assignments' => (new AssignmentModel())->getByMaterial($materialId),
            'submissions' => (new SubmissionModel())->getByStudentForAssignments(
                session()->get('student_id'),
                array_column((new AssignmentModel())->getByMaterial($materialId), 'id')
            ),
            'progress'   => (new StudentMaterialProgressModel())
                ->where('student_id', session()->get('student_id'))
                ->where('material_id', $materialId)
                ->first(),
            'activeTab'  => $tab,
            'profile'    => (new UserService())->getUserProfile(),
        ];

        if ($tab === 'material') {
            $data['submaterials'] = (new SubmaterialModel())->getByMaterial($materialId);
        }

        return view('murid/mission_detail', $data);
    }

    private function findStudentMaterial(int $materialId): array
    {
        $material = (new MaterialModel())->findForStudentClass($materialId, (string) session()->get('student_class'));
        if (!$material) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $material;
    }
}
