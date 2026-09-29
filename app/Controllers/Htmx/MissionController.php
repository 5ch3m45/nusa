<?php

namespace App\Controllers\Htmx;

use App\Controllers\BaseController;

class MissionController extends BaseController
{
    public function index()
    {
        $user = (new \App\Services\UserService())->getUserProfile();
        $missions = (new \App\Services\MissionService())->getMissionsByClassAndSemester($user['class'] ?? 1, 1);
        
        return view('htmx/mission', [
            'missions' => $missions,
        ]);
    }

    public function semester($semester)
    {
        $user = (new \App\Services\UserService())->getUserProfile();
        $missions = (new \App\Services\MissionService())->getMissionsByClassAndSemester($user['class'] ?? 1, (int) $semester);
        
        return view('htmx/mission', [
            'missions' => $missions,
        ]);
    }
}
