<?php

namespace App\Services;

class MissionService
{
    public function getMissions()
    {
        // Simulate fetching mission data from a database or API
        return [
            'missions' => [
                [
                    'id' => 1,
                    'class' => 1,
                    'semester' => 1,
                    'chapter' => 1,
                    'title' => 'Misteri Tumbuhan & Energi x Teks Eksplanasi',
                    'description' => 'Deskripsi misi pertama',
                    'difficulty' => 3,
                ],
                [
                    'id' => 2,
                    'class' => 1,
                    'semester' => 1,
                    'chapter' => 2,
                    'title' => 'Gaya di Sekitar Kita x Laporan Hasil Pengamatan',
                    'description' => 'Deskripsi misi kedua',
                    'difficulty' => 3
                ],
                [
                    'id' => 3,
                    'class' => 1,
                    'semester' => 1,
                    'chapter' => 3,
                    'title' => 'Jejak Budaya Daerahku x Cerita Rakyat & Wawancara',
                    'description' => 'Deskripsi misi ketiga',
                    'difficulty' => 3
                ],
                [
                    'id' => 4,
                    'class' => 1,
                    'semester' => 1,
                    'chapter' => 4,
                    'title' => 'Pasar & Ekonomi Cilik x Teks Prosedur Jual-Beli',
                    'description' => 'Deskripsi misi keempat',
                    'difficulty' => 3
                ],
                [
                    'id' => 5,
                    'class' => 1,
                    'semester' => 2,
                    'chapter' => 5,
                    'title' => 'Pahlawan Nusantara x Teks Biografi Tokoh',
                    'description' => 'Deskripsi misi kelima',
                    'difficulty' => 3
                ],
                [
                    'id' => 6,
                    'class' => 1,
                    'semester' => 2,
                    'chapter' => 6,
                    'title' => 'Peta & Bentang Alam x Petunjuk Arah & Denah',
                    'description' => 'Deskripsi misi keenam',
                    'difficulty' => 3
                ],
                [
                    'id' => 7,
                    'class' => 1,
                    'semester' => 2,
                    'chapter' => 7,
                    'title' => 'Bijak Berteknologi x Pesan Singkat & Surat',
                    'description' => 'Deskripsi misi ketujuh',
                    'difficulty' => 3
                ],
                [
                    'id' => 8,
                    'class' => 1,
                    'semester' => 2,
                    'chapter' => 8,
                    'title' => 'Kelestarian Bumi x Teks Persuasi & Poster Ajakan',
                    'description' => 'Deskripsi misi kedelapan',
                    'difficulty' => 3
                ]
            ]
        ];
    }

    public function getMissionsById($missionId)
    {
        $missions = $this->getMissions()['missions'];
        foreach ($missions as $mission) {
            if ($mission['id'] === $missionId) {
                return $mission;
            }
        }
        return null; // Return null if mission not found
    }

    public function getMissionsByClassAndSemester($class, $semester)
    {
        $missions = $this->getMissions()['missions'];
        $filteredMissions = [];
        foreach ($missions as $mission) {
            if ($mission['class'] === $class && $mission['semester'] === $semester) {
                $filteredMissions[] = $mission;
            }
        }
        return $filteredMissions;
    }
}
