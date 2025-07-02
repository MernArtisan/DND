<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('web.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password.',
            ]);
        }

        // Generate OTP
        $otp = rand(1000, 9999);

        DB::table('user_otps')->updateOrInsert(
            ['user_id' => $user->id],
            ['otp' => $otp, 'created_at' => now()]
        );

        // Send OTP via email
        try {
            Mail::raw("Your login OTP is: $otp", function ($msg) use ($user) {
                $msg->to($user->email)->subject('Your OTP Code');
            });

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully to your email.',
                'user_id' => $user->id,
                'otp' => $otp
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
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
