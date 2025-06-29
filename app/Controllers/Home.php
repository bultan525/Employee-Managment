<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {

        $this->data['title'] = 'Dashboard';

        return view('admin/index',$this->data);
    }
}
