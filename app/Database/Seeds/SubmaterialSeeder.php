<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubmaterialSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            // Bilangan Bulat (material 2)
            [
                'material_id' => 2,
                'type'        => 'text',
                'title'       => 'Apa Itu Bilangan Bulat?',
                'content'     => "Bilangan bulat terdiri dari bilangan positif, nol, dan bilangan negatif.\n\nContoh: ... -3, -2, -1, 0, 1, 2, 3 ...\nBilangan bulat tidak memiliki pecahan atau desimal.",
                'url'         => null,
                'sort_order'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'material_id' => 2,
                'type'        => 'youtube',
                'title'       => 'Video: Mengenal Bilangan Bulat',
                'content'     => null,
                'url'         => 'https://www.youtube.com/watch?v=8hPpD69Z0Mk',
                'sort_order'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'material_id' => 2,
                'type'        => 'mp3',
                'title'       => 'Audio: Ringkasan Bilangan Bulat',
                'content'     => null,
                'url'         => 'uploads/bilangan-bulat.mp3',
                'sort_order'  => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            // Aljabar Dasar (material 3)
            [
                'material_id' => 3,
                'type'        => 'text',
                'title'       => 'Variabel dan Persamaan',
                'content'     => "Variabel adalah simbol yang mewakili nilai yang belum diketahui, biasanya ditulis dengan huruf seperti x atau y.\n\nContoh: x + 5 = 12, maka x = 7.",
                'url'         => null,
                'sort_order'  => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'material_id' => 3,
                'type'        => 'slides',
                'title'       => 'Slide: Pengenalan Aljabar',
                'content'     => null,
                'url'         => 'https://docs.google.com/presentation/d/1AbCdEfGhIjKlMnOpQrStUvWxYz/edit',
                'sort_order'  => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        $this->db->table('submaterials')->insertBatch($data);
    }
}
