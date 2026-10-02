<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookStoreMaterialSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['book_store_id' => 1, 'title' => 'Bilangan Bulat', 'content' => 'Materi dasar bilangan bulat.', 'chapter' => 'Bab 1', 'subject' => 'Matematika', 'class' => '7A', 'semester' => 1],
            ['book_store_id' => 1, 'title' => 'Aljabar', 'content' => 'Pengenalan aljabar.', 'chapter' => 'Bab 2', 'subject' => 'Matematika', 'class' => '7A', 'semester' => 1],
            ['book_store_id' => 2, 'title' => 'Zat', 'content' => 'Wujud zat.', 'chapter' => 'Bab 1', 'subject' => 'IPA', 'class' => '8A', 'semester' => 1],
            ['book_store_id' => 4, 'title' => 'Kerajaan Nusantara', 'content' => 'Kerajaan-kerajaan awal.', 'chapter' => 'Bab 1', 'subject' => 'Sejarah', 'class' => '8B', 'semester' => 2],
        ];

        foreach ($data as &$d) {
            $d['created_at'] = date('Y-m-d H:i:s');
            $d['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('book_store_materials')->insertBatch($data);
    }
}
