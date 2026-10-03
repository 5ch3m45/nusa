<?php

namespace App\Controllers\Htmx;

use App\Controllers\BaseController;
use App\Services\UserService;

class HomeController extends BaseController
{
    public function index()
    {
        return view('murid/htmx/home', [
            'profile' => (new UserService())->getUserProfile()
        ]);
    }
}
