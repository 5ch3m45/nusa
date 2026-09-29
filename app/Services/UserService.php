<?php

namespace App\Services;

class UserService
{
    public function getUserProfile()
    {
        // Simulate fetching user profile data from a database or API
        return [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'class' => 1,
            'stats' => (new StatsService())->getStatsByUserId(1),
            'latest_progress' => (new ProgressService())->getTheLatestProgressByUserId(1)
        ];
    }
    
}