<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;

class MyForgotPasswordController extends ForgotPasswordController
{
    public function showLinkRequestForm()
    {
        return view('layouts.adminlte.password-recovery');
    }
}
