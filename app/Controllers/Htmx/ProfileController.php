<?php

namespace App\Controllers\Htmx;

use App\Controllers\BaseController;
use App\Services\UserService;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        return view('murid/htmx/profile', [
            'profile' => (new UserService())->getUserProfile(),
        ]);
    }
}
