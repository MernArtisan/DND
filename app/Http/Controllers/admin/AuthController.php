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
                Log::info('Auth attempt successful for user: ' . Auth::user()->email);

                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.dashboard')
                        ->with('success', 'Login Successful, ' . Auth::user()->name);
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Access Denied: You are not authorized to access admin panel.');
                }
            } else {
                Log::warning('Auth attempt failed for email: ' . $request->email);
            }


            return redirect()->back()->with('error', 'Invalid Credentials');
        } catch (Exception $e) {
            Log::error($e);
            return back()->withErrors([
                'error' => 'There was an error processing your request. Please try again later.',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Logout Successful');
    }
}
