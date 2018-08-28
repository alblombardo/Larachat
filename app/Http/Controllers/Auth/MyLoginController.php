<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyLoginController extends LoginController
{
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLogin()
    {
        return view('layouts.adminlte.login');
    }

    public function showPasswordRecovery()
    {
        return view('layouts.adminlte.password-recovery');
    }
}
