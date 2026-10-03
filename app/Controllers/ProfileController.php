<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\UserService;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        return view('murid/profile', [
            'profile' => (new UserService())->getUserProfile(),
        ]);
    }
}
