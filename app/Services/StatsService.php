<?php

namespace App\Services;

class StatsService
{
    public function getStatsByUserId($userId)
    {
        // Simulate fetching stats data from a database or API
        return [
            'stars' => 12,
            'missions' => 8,
            'average' => 92
        ];
    }
}
