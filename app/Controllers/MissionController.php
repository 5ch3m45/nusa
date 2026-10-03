<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AssignmentModel;
use App\Models\BookModel;
use App\Models\MaterialModel;
use App\Models\StudentMaterialProgressModel;
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

        return view('murid/mission_detail', [
            'page'       => 'missions',
            'material'   => $material,
            'book'       => $material['book_id'] ? (new BookModel())->find($material['book_id']) : null,
            'assignments' => (new AssignmentModel())->getByMaterial($materialId),
            'progress'   => (new StudentMaterialProgressModel())
                ->where('student_id', session()->get('student_id'))
                ->where('material_id', $materialId)
                ->first(),
            'activeTab'  => $tab,
            'profile'    => (new UserService())->getUserProfile(),
        ]);
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
