<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookStoreAssignmentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['book_store_id' => 1, 'title' => 'Latihan Bilangan', 'description' => 'Soal nomor 1-5.', 'subject' => 'Matematika', 'class' => '7A', 'semester' => 1, 'due_date' => date('Y-m-d', strtotime('+7 days'))],
            ['book_store_id' => 2, 'title' => 'Laporan Zat', 'description' => 'Buat laporan pengamatan.', 'subject' => 'IPA', 'class' => '8A', 'semester' => 1, 'due_date' => date('Y-m-d', strtotime('+14 days'))],
            ['book_store_id' => 4, 'title' => 'Peta Kerajaan', 'description' => 'Gambar peta kerajaan.', 'subject' => 'Sejarah', 'class' => '8B', 'semester' => 2, 'due_date' => date('Y-m-d', strtotime('+21 days'))],
        ];

        foreach ($data as &$d) {
            $d['created_at'] = date('Y-m-d H:i:s');
            $d['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('book_store_assignments')->insertBatch($data);
    }
}
