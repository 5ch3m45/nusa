<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function signup()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/guru');
        }
        return view('auth/signup');
    }

    public function doSignup()
    {
        $rules = [
            'name'     => 'required|min_length[2]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|in_list[guru,murid]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => $this->request->getPost('role'),
        ];

        $this->userModel->insert($data);

        $user = $this->userModel->findByEmail($data['email']);
        session()->set('user_id', $user['id']);
        session()->set('user_name', $user['name']);
        session()->set('user_role', $user['role']);

        return redirect()->to('/guru')->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user['name']);
    }

    public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/guru');
        }
        return view('auth/login');
    }

    public function doLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        session()->set('user_id', $user['id']);
        session()->set('user_name', $user['name']);
        session()->set('user_role', $user['role']);

        if ($user['role'] === 'guru') {
            return redirect()->to('/guru')->with('success', 'Selamat datang, ' . $user['name']);
        }

        return redirect()->to('/')->with('success', 'Selamat datang, ' . $user['name']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }
}
