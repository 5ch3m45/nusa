<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookStoreSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['title' => 'Paket Matematika 7', 'type' => 'link', 'url_or_path' => 'https://example.com/paket-mtk7', 'subject' => 'Matematika', 'class' => '7A', 'semester' => 1, 'description' => 'Paket lengkap matematika kelas 7.'],
            ['title' => 'Paket IPA 8', 'type' => 'pdf', 'url_or_path' => 'uploads/paket-ipa8.pdf', 'subject' => 'IPA', 'class' => '8A', 'semester' => 1, 'description' => 'Referensi IPA kelas 8.'],
            ['title' => 'Latihan Bahasa Indonesia 9', 'type' => 'link', 'url_or_path' => 'https://example.com/lat-bindo9', 'subject' => 'Bahasa Indonesia', 'class' => '9A', 'semester' => 2, 'description' => 'Bank soal Bahasa Indonesia.'],
            ['title' => 'Sejarah Nusantara', 'type' => 'pdf', 'url_or_path' => 'uploads/sejarah-nusantara.pdf', 'subject' => 'Sejarah', 'class' => '8B', 'semester' => 2, 'description' => 'Ringkasan sejarah Indonesia.'],
        ];

        foreach ($data as &$d) {
            $d['created_at'] = date('Y-m-d H:i:s');
            $d['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('book_store')->insertBatch($data);
    }
}
