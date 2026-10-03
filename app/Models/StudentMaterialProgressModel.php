<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentMaterialProgressModel extends Model
{
    protected $table            = 'student_material_progress';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['student_id', 'material_id', 'is_done', 'started_at', 'done_at', 'last_accessed_at', 'score'];

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

    public function getByStudent(int $studentId)
    {
        return $this->db->table('student_material_progress')
            ->select('student_material_progress.*, materials.title, materials.subject, materials.chapter, materials.class, materials.semester')
            ->join('materials', 'materials.id = student_material_progress.material_id')
            ->where('student_material_progress.student_id', $studentId)
            ->orderBy('student_material_progress.last_accessed_at', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getLatestInProgress(int $studentId)
    {
        return $this->db->table('student_material_progress')
            ->select('student_material_progress.*, materials.title, materials.subject, materials.chapter, materials.class, materials.semester')
            ->join('materials', 'materials.id = student_material_progress.material_id')
            ->where('student_material_progress.student_id', $studentId)
            ->orderBy('student_material_progress.is_done', 'ASC')
            ->orderBy('COALESCE(student_material_progress.last_accessed_at, student_material_progress.started_at, student_material_progress.updated_at)', 'DESC', false)
            ->limit(1)
            ->get()
            ->getRowArray();
    }

    public function start(int $studentId, int $materialId)
    {
        $row = $this->where('student_id', $studentId)->where('material_id', $materialId)->first();
        $now = date('Y-m-d H:i:s');

        if (!$row) {
            return $this->insert([
                'student_id'       => $studentId,
                'material_id'      => $materialId,
                'started_at'       => $now,
                'last_accessed_at' => $now,
            ]);
        }

        $data = ['last_accessed_at' => $now];
        if (empty($row['started_at'])) {
            $data['started_at'] = $now;
        }

        return $this->update($row['id'], $data);
    }

    public function complete(int $studentId, int $materialId, ?float $score = null)
    {
        $this->start($studentId, $materialId);

        $row  = $this->where('student_id', $studentId)->where('material_id', $materialId)->first();
        $data = [
            'is_done' => 1,
            'done_at' => date('Y-m-d H:i:s'),
        ];
        if ($score !== null) {
            $data['score'] = $score;
        }

        return $this->update($row['id'], $data);
    }
}
