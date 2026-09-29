<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MissionController extends BaseController
{
    public function index()
    {
        $user = (new \App\Services\UserService())->getUserProfile();
        $missions = (new \App\Services\MissionService())->getMissionsByClassAndSemester($user['class'] ?? 4, 1);

        return view('mission', [
            'page' => 'missions',
            'missions' => $missions,
        ]);
    }
}
