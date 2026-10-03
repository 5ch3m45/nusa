<?php

namespace App\Controllers\Htmx;

use App\Controllers\BaseController;
use App\Models\AssignmentModel;
use App\Models\BookModel;
use App\Models\MaterialModel;
use App\Models\StudentMaterialProgressModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MissionController extends BaseController
{
    public function index()
    {
        $materials = (new MaterialModel())->getByClassAndSemester(
            (string) session()->get('student_class'),
            1,
            session()->get('student_id')
        );

        return view('murid/htmx/mission', [
            'materials' => $materials,
            'semester'  => 1,
        ]);
    }

    public function semester($semester)
    {
        $semester  = (int) $semester;
        $materials = (new MaterialModel())->getByClassAndSemester(
            (string) session()->get('student_class'),
            $semester,
            session()->get('student_id')
        );

        return view('murid/htmx/mission', [
            'materials' => $materials,
            'semester'  => $semester,
        ]);
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

    private function renderDetail(int $materialId, string $tab)
    {
        $material = (new MaterialModel())->findForStudentClass($materialId, (string) session()->get('student_class'));
        if (!$material) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('murid/htmx/mission_detail', [
            'material'    => $material,
            'book'        => $material['book_id'] ? (new BookModel())->find($material['book_id']) : null,
            'assignments' => (new AssignmentModel())->getByMaterial($materialId),
            'progress'    => (new StudentMaterialProgressModel())
                ->where('student_id', session()->get('student_id'))
                ->where('material_id', $materialId)
                ->first(),
            'activeTab'   => $tab,
        ]);
    }
}
