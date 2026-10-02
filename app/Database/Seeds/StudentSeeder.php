<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $names = [
            'Andi Pratama', 'Budi Santoso', 'Citra Lestari', 'Dewi Anggraini',
            'Eko Wijaya', 'Fajar Ramadhan', 'Gita Pramesti', 'Hadi Prasetyo',
            'Intan Permata', 'Joko Susilo',
        ];

        $classes = ['7A', '7B', '8A', '8B', '9A'];

        $data = [];
        foreach ($names as $i => $name) {
            $data[] = [
                'guru_id'       => 1,
                'username'      => 'siswa' . ($i + 1),
                'password_hash' => password_hash('password', PASSWORD_DEFAULT),
                'name'          => $name,
                'class'         => $classes[$i % count($classes)],
                'phone'         => '0812' . str_pad((string) (10000000 + $i), 8, '0', STR_PAD_LEFT),
                'parent_name'   => 'Ortu ' . $name,
                'address'       => 'Jl. Contoh No. ' . ($i + 1) . ', Jakarta',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('students')->insertBatch($data);
    }
}
