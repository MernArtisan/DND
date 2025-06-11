<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('web.auth.login');
    }

    public function signup()
    {
        return view('web.auth.signup');
    }

    public function verifyOtp()
    {
        return view('web.auth.otp');
    }
}
