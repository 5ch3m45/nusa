<?php

namespace App\Controllers\Htmx;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AchievementController extends BaseController
{
    public function index()
    {
        return view('murid/htmx/achievement');
    }
}
