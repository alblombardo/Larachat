<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class MyResetPasswordController extends ResetPasswordController
{
    protected $redirectTo = '/admin';

    public function showResetForm(Request $request, $token = null)
    {
        return view('layouts.adminlte.password-reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
