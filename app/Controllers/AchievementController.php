<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AchievementController extends BaseController
{
    public function index()
    {
        return view('murid/achievement');
    }
}
