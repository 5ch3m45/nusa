<?php

namespace App\Controllers\Htmx;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        return view('htmx/profile');
    }
}
