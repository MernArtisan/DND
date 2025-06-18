<?php

namespace App\Http\Controllers\api;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TwilioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function signin(Request $request)
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
            return response()->json([
                'status' => false,
                'message' => 'Failed to send OTP.',
                'error' => $e->getMessage()
            ]);
        }
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string',
        ]);

        try {
            $email = $request->email;

            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json(['status' => false, 'message' => 'User not found']);
            }

            $record = DB::table('user_otps')->where('user_id', $user->id)->first();

            if (!$record || $record->otp !== $request->otp) {
                return response()->json(['status' => false, 'message' => 'Invalid OTP']);
            }

            $otpCreated = \Carbon\Carbon::parse($record->created_at);
            if ($otpCreated->diffInSeconds(now()) > 60) {
                DB::table('user_otps')->where('user_id', $user->id)->delete();
                return response()->json(['status' => false, 'message' => 'OTP expired']);
            }

            DB::table('user_otps')->where('user_id', $user->id)->delete();

            $user->last_login_at = now();
            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => $user->name . ' Login successful',
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'phone_code' => $user->phone_code,
                    'phone' => $user->phone,
                    'bio' => $user->bio,
                    'country' => $user->country,
                    'state' => $user->state,
                    'city' => $user->city,
                    'zip_code' => $user->zip_code,
                    'email_verified_at' => $user->email_verified_at,
                    'gender' => $user->gender,
                    'address' => $user->address,
                    'image' => $user->image ? asset($user->image) : asset('default-man.png'),
                    'last_login_at' => $user->last_login_at,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Failed to verify OTP.',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function signup(Request $request)
    {

        $validated = $this->validateUser($request);
        $user = $this->createUser($validated);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully.',
            'user' => $user
        ]);
    }
    private function validateUser(Request $request)
    {
        return $request->validate([
            'role' => 'required|in:user,streamer',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_code' => 'required|string',
            'phone' => 'required|string|unique:users',
            'password' => 'required|confirmed',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|in:male,female,other',
        ]);
    }
    private function createUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function sendPasswordResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = rand(1000, 9999);
        $resetToken = Str::uuid();

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $otp,
                'email' => $user->email,
                'created_at' => now(),
            ]
        );

        Mail::raw("Your password reset OTP is: $otp", function ($msg) use ($user) {
            $msg->to($user->email)->subject('Reset Password OTP');
        });

        return ApiResponse::success('OTP sent successfully.', [
            'otp' => $otp
        ]);
    }

    public function verifyResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        $otpCheck = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->otp,
        ])->first();
        if (!$otpCheck) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 401);
        }

        return ApiResponse::success('OTP verified successfully!', []);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'error' => 'User not found with this email.'
            ]);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Password reset successfully!',
        ], 200);
    }
}
