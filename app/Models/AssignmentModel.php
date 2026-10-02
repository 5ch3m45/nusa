<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignmentModel extends Model
{
    protected $table            = 'assignments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru_id', 'book_id', 'material_id', 'title', 'description', 'subject', 'class', 'semester', 'due_date'];

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

    public function getByGuru(int $guruId)
    {
        return $this->where('guru_id', $guruId)->findAll();
    }

    public function getByGuruAndClass(int $guruId, string $class)
    {
        return $this->where('guru_id', $guruId)->where('class', $class)->findAll();
    }

    public function getByGuruAndSubject(int $guruId, string $subject)
    {
        return $this->where('guru_id', $guruId)->where('subject', $subject)->findAll();
    }

    public function getByBook(int $bookId)
    {
        return $this->where('book_id', $bookId)->findAll();
    }

    public function getByMaterial(int $materialId)
    {
        return $this->where('material_id', $materialId)->findAll();
    }

    public function getAssignmentsWithDetails(int $guruId)
    {
        return $this->db->table('assignments')
            ->select('assignments.*, books.title as book_title, materials.title as material_title')
            ->join('books', 'books.id = assignments.book_id', 'left')
            ->join('materials', 'materials.id = assignments.material_id', 'left')
            ->where('assignments.guru_id', $guruId)
            ->get()
            ->getResultArray();
    }
}
