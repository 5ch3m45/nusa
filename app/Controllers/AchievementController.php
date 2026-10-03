<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\UserService;
use CodeIgniter\HTTP\ResponseInterface;

class AchievementController extends BaseController
{
    public function index()
    {
        return view('murid/achievement', [
            'profile' => (new UserService())->getUserProfile(),
        ]);
    }
}
