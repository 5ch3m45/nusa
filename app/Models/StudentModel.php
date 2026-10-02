<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru_id', 'username', 'password_hash', 'name', 'class', 'phone', 'parent_name', 'address'];

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

    public function searchByGuru(int $guruId, string $search)
    {
        return $this->where('guru_id', $guruId)
            ->like('name', $search)
            ->orLike('class', $search)
            ->orLike('username', $search)
            ->findAll();
    }

    public function findByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }

    public function resetPassword(int $id, string $newPassword = '123456')
    {
        return $this->update($id, [
            'password_hash' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);
    }
}
