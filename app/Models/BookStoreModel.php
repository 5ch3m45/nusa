<?php

namespace App\Models;

use CodeIgniter\Model;

class BookStoreModel extends Model
{
    protected $table            = 'book_store';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'type', 'url_or_path', 'subject', 'class', 'semester', 'description'];

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

    public function search(string $keyword)
    {
        return $this->like('title', $keyword)
            ->orLike('subject', $keyword)
            ->orLike('class', $keyword)
            ->findAll();
    }

    public function filter(string $class = '', string $subject = '', int $semester = 0)
    {
        $builder = $this;
        if ($class) {
            $builder = $builder->where('class', $class);
        }
        if ($subject) {
            $builder = $builder->where('subject', $subject);
        }
        if ($semester) {
            $builder = $builder->where('semester', $semester);
        }
        return $builder->findAll();
    }

    public function getWithDetails(int $id)
    {
        $book = $this->find($id);
        if (!$book) return null;

        $materialModel = new \App\Models\BookStoreMaterialModel();
        $assignmentModel = new \App\Models\BookStoreAssignmentModel();

        $book['materials'] = $materialModel->where('book_store_id', $id)->findAll();
        $book['assignments'] = $assignmentModel->where('book_store_id', $id)->findAll();

        return $book;
    }
}
