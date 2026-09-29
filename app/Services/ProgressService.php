<?php

namespace App\Services;

class ProgressService
{
    public function getTheLatestProgressByUserId($userId)
    {
        // Simulate fetching progress data from a database or API
        return [
            'mission_id' => 2,
            'mission' => (new MissionService())->getMissionsById(2),
            'user_id' => $userId,
            'status' => 'in_progress',
            'score' => 60
        ];
    }
}
