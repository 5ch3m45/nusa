<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['guru_id' => 1, 'title' => 'Matematika Kelas 7', 'type' => 'pdf', 'url_or_path' => 'uploads/matematika-7.pdf', 'subject' => 'Matematika', 'class' => '7A', 'semester' => 1],
            ['guru_id' => 1, 'title' => 'IPA Terpadu Kelas 8', 'type' => 'pdf', 'url_or_path' => 'uploads/ipa-8.pdf', 'subject' => 'IPA', 'class' => '8A', 'semester' => 1],
            ['guru_id' => 1, 'title' => 'Bahasa Indonesia Kelas 9', 'type' => 'link', 'url_or_path' => 'https://example.com/bindo-9', 'subject' => 'Bahasa Indonesia', 'class' => '9A', 'semester' => 2],
            ['guru_id' => 2, 'title' => 'Sejarah Indonesia', 'type' => 'pdf', 'url_or_path' => 'uploads/sejarah.pdf', 'subject' => 'Sejarah', 'class' => '8B', 'semester' => 2],
        ];

        foreach ($data as &$d) {
            $d['created_at'] = date('Y-m-d H:i:s');
            $d['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('books')->insertBatch($data);
    }
}
