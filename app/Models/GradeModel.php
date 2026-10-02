<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table            = 'grades';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['assignment_id', 'student_id', 'score', 'feedback'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    protected $cleanValidationRules = true;

    protected $callbacks = [];
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert  = [];
    protected $beforeUpdate = [];
    protected $afterUpdate  = [];
    protected $beforeFind   = [];
    protected $afterFind    = [];
    protected $beforeDelete = [];
    protected $afterDelete  = [];

    public function getByAssignment(int $assignmentId)
    {
        return $this->where('assignment_id', $assignmentId)->findAll();
    }

    public function getByStudent(int $studentId)
    {
        return $this->where('student_id', $studentId)->findAll();
    }

    public function getByAssignmentAndStudent(int $assignmentId, int $studentId)
    {
        return $this->where('assignment_id', $assignmentId)
            ->where('student_id', $studentId)
            ->first();
    }

    public function getGradesWithDetails(int $guruId)
    {
        return $this->db->table('grades')
            ->select('grades.*, students.name as student_name, students.class, assignments.title as assignment_title, assignments.subject')
            ->join('students', 'students.id = grades.student_id')
            ->join('assignments', 'assignments.id = grades.assignment_id')
            ->where('assignments.guru_id', $guruId)
            ->get()
            ->getResultArray();
    }
}
