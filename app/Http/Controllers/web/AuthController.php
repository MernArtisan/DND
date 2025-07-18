<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('web.auth.login');
    }

    public function authenticate(Request $request)
    {
        // return $request->all();
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:4',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return back()->with('error', 'Invalid Credentials')->withErrors(['email' => 'Invalid email or password.'])->withInput();
            }

            // Check if OTP was recently sent (within 60 seconds)
            $otpRecord = DB::table('user_otps')->where('user_id', $user->id)->first();

            if ($otpRecord && now()->diffInSeconds($otpRecord->created_at) < 60) {
                $otp = $otpRecord->otp;
            } else {
                $otp = rand(1000, 9999);
                DB::table('user_otps')->updateOrInsert(
                    ['user_id' => $user->id],
                    ['otp' => $otp, 'created_at' => now()]
                );
            }

            try {
                // Send OTP via email
                Mail::raw("Your login OTP is: $otp", function ($msg) use ($user) {
                    $msg->to($user->email)->subject('Your OTP Code');
                });

                session([
                    'otp_user_id' => $user->id,
                    'otp_sent_at' => now()
                ]);

                return redirect()->route('verifyOtp.index')->with('success', 'OTP sent to your email.');
            } catch (\Exception $e) {
                Log::error('OTP email error: ' . $e->getMessage(), [
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                ]);
                return back()->with('error', 'Failed to send OTP. Please try again.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to authenticate user: ' . $e->getMessage());
        }
    }



    public function signup()
    {
        if (auth()->check()) {
            return redirect()->route('home.index')->with('error', 'You are already logged in.');
        }
        return view('web.auth.signup');
    }

    public function signupSubmit(SignupRequest $request, UserService $userService)
    {
        $user = $userService->createUser($request->validated());

        auth()->login($user);

        return redirect()->route('home.index')->with('success', 'Registration successful! Welcome aboard.');
    }


    public function verifyOtp()
    {
        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login.index')->with('error', 'Session expired.');
        }

        $otpRecord = DB::table('user_otps')->where('user_id', $userId)->first();

        if (!$otpRecord) {
            return redirect()->route('login.index')->with('error', 'No OTP found.');
        }

        $otpCreatedAt = \Carbon\Carbon::parse($otpRecord->created_at);
        $otpExpiryTimestamp = $otpCreatedAt->addSeconds(60)->timestamp * 1000;  

        return view('web.auth.otp', [
            'otpExpiryTimestamp' => $otpExpiryTimestamp,
        ]);
    }


    public function verifyOtpSubmit(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required|digits:4',
            ]);

            $userId = session('otp_user_id');

            if (!$userId) {
                return redirect()->route('login.index')->with('error', 'Session expired. Please login again.');
            }

            $otpRecord = DB::table('user_otps')->where('user_id', $userId)->first();

            if (!$otpRecord) {
                return back()->with('error', 'OTP not found.');
            }

            // Check if OTP expired
            $otpCreated = \Carbon\Carbon::parse($otpRecord->created_at);
            if ($otpCreated->addSeconds(60)->isPast()) {
                return back()->with('error', 'OTP has expired. Please request a new one.');
            }

            if ($otpRecord->otp != $request->otp) {
                return back()->with('error', 'Invalid OTP. Please try again.');
            }

            $user = User::find($userId);
            auth()->login($user);

            session()->forget(['otp_user_id', 'otp_sent_at']);
            DB::table('user_otps')->where('user_id', $userId)->delete();

            return redirect()->route('home.index')->with('success', 'You are now logged in.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to verify OTP: ' . $e->getMessage());
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            $userId = session('otp_user_id');

            if (!$userId) {
                return response()->json(['message' => 'Session expired. Please login again.'], 401);
            }

            $user = User::find($userId);
            if (!$user) {
                return response()->json(['message' => 'User not found.'], 404);
            }

            $otpRecord = DB::table('user_otps')->where('user_id', $user->id)->first();
            // return $otpRecord;

            if ($otpRecord && now()->diffInSeconds($otpRecord->created_at) < 60) {
                DB::table('user_otps')->where('user_id', $user->id)->delete();
            }

            // Generate new OTP
            $otp = rand(1000, 9999);

            DB::table('user_otps')->updateOrInsert(
                ['user_id' => $user->id],
                ['otp' => $otp, 'created_at' => now()]
            );

            try {
                Mail::raw("Your new OTP is: $otp", function ($msg) use ($user) {
                    $msg->to($user->email)->subject('Your New OTP Code');
                });

                return response()->json(['message' => 'New OTP has been sent.']);
            } catch (\Exception $e) {
                Log::error('Resend OTP error: ' . $e->getMessage());
                return response()->json(['message' => 'Failed to send OTP. Try again.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Somthing went wrong while' . $e->getMessage()], 500);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Prevent CSRF attacks

        return redirect()->route('login.index')->with('success', 'You have been logged out.');
    }
}