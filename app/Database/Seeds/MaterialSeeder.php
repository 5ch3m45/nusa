<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['guru_id' => 1, 'book_id' => 1, 'title' => 'Bilangan Bulat', 'subject' => 'Matematika', 'chapter' => 'Bab 1', 'semester' => 1, 'class' => '7A', 'content' => 'Pengenalan bilangan bulat positif dan negatif.'],
            ['guru_id' => 1, 'book_id' => 1, 'title' => 'Aljabar Dasar', 'subject' => 'Matematika', 'chapter' => 'Bab 2', 'semester' => 1, 'class' => '7A', 'content' => 'Pengenalan variabel dan persamaan.'],
            ['guru_id' => 1, 'book_id' => 2, 'title' => 'Zat dan Wujudnya', 'subject' => 'IPA', 'chapter' => 'Bab 1', 'semester' => 1, 'class' => '8A', 'content' => 'Padat, cair, dan gas.'],
            ['guru_id' => 1, 'book_id' => 3, 'title' => 'Teks Narasi', 'subject' => 'Bahasa Indonesia', 'chapter' => 'Bab 3', 'semester' => 2, 'class' => '9A', 'content' => 'Struktur teks narasi.'],
            ['guru_id' => 2, 'book_id' => 4, 'title' => 'Kemerdekaan RI', 'subject' => 'Sejarah', 'chapter' => 'Bab 5', 'semester' => 2, 'class' => '8B', 'content' => 'Peristiwa proklamasi 1945.'],
        ];

        foreach ($data as &$d) {
            $d['created_at'] = date('Y-m-d H:i:s');
            $d['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('materials')->insertBatch($data);
    }
}
