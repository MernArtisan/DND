<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Login Successful, ' . Auth::user()->name);
            }

            return redirect()->back()->with('error', 'Invalid Credentials');
        } catch (Exception $e) {
            Log::error($e);
            return back()->withErrors([
                'error' => 'There was an error processing your request. Please try again later.',
            ]);
        }
    }
}
