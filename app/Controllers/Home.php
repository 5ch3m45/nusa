<?php

namespace App\Controllers;
use App\Services\UserService;

class Home extends BaseController
{
    public function index(): string
    {
        return view('murid/home', [
            'profile' => (new UserService())->getUserProfile()
        ]);
    }
}
