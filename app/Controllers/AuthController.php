<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{

    protected $employeeModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }
        $this->data['title'] = 'Login';
        return view('login', $this->data);
    }

    // public function attemptToLogin()
    // {
    //     $username = $this->request->getPost('username');
    //     $password = $this->request->getPost('password');

    //     $user = $authModel->where('user_name', $username)->first();

    //     if ($user && password_verify($password, $user['password'])) {
    //         session()->set([
    //             'logged_in' => true,
    //             'user_id'   => $user['id'],
    //             'user_name' => $user['user_name'],
    //             'name'      => $user['name'],
    //         ]);
    //         return redirect()->to('/dashboard');
    //     } else {
    //         return redirect()->back()->with('error', 'Invalid credentials');
    //     }
    // }

    public function attemptToLogin()
    {
        $this->data = [
            'success' => false,
            'hash'    => csrf_hash(),
        ];

        $validation = \Config\Services::validation();

        $rules = [
            'username'      => 'required',
            'password'      => 'required',
        ];

        $messages = [
            'username' => [
                'required' => 'Username is required.',
            ],
            'password' => [
                'required' => 'Password is required.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            $this->data['errors'] = $this->validator->getErrors();
            return $this->response->setJSON($this->data);
        }
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->authModel->where('user_name', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'logged_in' => true,
                'user_id'   => $user['id'],
                'user_name' => $user['user_name'],
                'name'      => $user['name'],
            ]);
            // return redirect()->to('/dashboard');
            $this->data['success'] = true;
            $this->data['redirect'] = base_url('admin/dashboard');
            $this->data['message'] = 'Login Successfully!';
            return $this->response->setJSON($this->data);
        } else {
            $this->data['message'] = 'Invalid credentials';
            return $this->response->setJSON($this->data);
        }
    }

    public function logout()
    {
        // Destroy the entire session
        session()->destroy();
        // return redirect()->to(base_url('/'));
        $this->data['success'] = true;
        $this->data['redirect'] = base_url('/');
        return $this->response->setJSON($this->data);
    }

}
