<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['guru_id' => 1, 'book_id' => 1, 'material_id' => 1, 'title' => 'Latihan Bilangan Bulat', 'description' => 'Kerjakan soal nomor 1-10.', 'subject' => 'Matematika', 'class' => '7A', 'semester' => 1, 'due_date' => date('Y-m-d', strtotime('+7 days'))],
            ['guru_id' => 1, 'book_id' => 1, 'material_id' => 2, 'title' => 'Persamaan Aljabar', 'description' => 'Selesaikan persamaan berikut.', 'subject' => 'Matematika', 'class' => '7A', 'semester' => 1, 'due_date' => date('Y-m-d', strtotime('+14 days'))],
            ['guru_id' => 1, 'book_id' => 2, 'material_id' => 3, 'title' => 'Pengamatan Zat', 'description' => 'Amati 3 benda di sekitar.', 'subject' => 'IPA', 'class' => '8A', 'semester' => 1, 'due_date' => date('Y-m-d', strtotime('+10 days'))],
            ['guru_id' => 2, 'book_id' => 4, 'material_id' => 5, 'title' => 'Esai Proklamasi', 'description' => 'Tulis esai 300 kata.', 'subject' => 'Sejarah', 'class' => '8B', 'semester' => 2, 'due_date' => date('Y-m-d', strtotime('+21 days'))],
        ];

        foreach ($data as &$d) {
            $d['created_at'] = date('Y-m-d H:i:s');
            $d['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('assignments')->insertBatch($data);
    }
}
