<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table            = 'materials';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru_id', 'book_id', 'title', 'subject', 'chapter', 'semester', 'class', 'content'];

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

    public function getByClassAndSemester(string $class, int $semester, ?int $studentId = null)
    {
        $select = 'materials.*';
        if ($studentId !== null) {
            $select .= ', student_material_progress.is_done, student_material_progress.score, student_material_progress.started_at, student_material_progress.done_at, student_material_progress.last_accessed_at';
        }

        $builder = $this->db->table('materials')
            ->select($select)
            ->where('materials.class', $class)
            ->where('materials.semester', $semester)
            ->orderBy('materials.id', 'ASC');

        if ($studentId !== null) {
            $builder->join(
                'student_material_progress',
                'student_material_progress.material_id = materials.id AND student_material_progress.student_id = ' . (int) $studentId,
                'left'
            );
        }

        return $builder->get()->getResultArray();
    }

    public function findForStudentClass(int $id, string $class)
    {
        return $this->where('id', $id)->where('class', $class)->first();
    }

    public function getMaterialsWithBook(int $guruId)
    {
        return $this->db->table('materials')
            ->select('materials.*, books.title as book_title, books.type as book_type')
            ->join('books', 'books.id = materials.book_id', 'left')
            ->where('materials.guru_id', $guruId)
            ->get()
            ->getResultArray();
    }
}
