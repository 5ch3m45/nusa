<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'          => 'Pak Guru',
                'email'         => 'guru@nusa.test',
                'password_hash' => password_hash('password', PASSWORD_DEFAULT),
                'role'          => 'guru',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Bu Guru',
                'email'         => 'buguru@nusa.test',
                'password_hash' => password_hash('password', PASSWORD_DEFAULT),
                'role'          => 'guru',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'name'          => 'Orang Tua Siswa',
                'email'         => 'orangtua@nusa.test',
                'password_hash' => password_hash('password', PASSWORD_DEFAULT),
                'role'          => 'orangtua',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
