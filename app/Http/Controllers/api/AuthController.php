<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function signin(Request $request, TwilioService $twilio)
    {
        $request->validate([
            'login_type' => 'required|in:email,phone',
            'value' => 'required|string',
        ]);

        $field = $request->login_type;
        $value = $request->value;

        $user = User::where($field, $value)->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }

        $otp = rand(1000, 9999);

        DB::table('user_otps')->updateOrInsert(
            ['user_id' => $user->id],
            ['otp' => $otp, 'created_at' => now()]
        );

        try {
            if ($field === 'email') {
                Mail::raw("Your OTP is: $otp", function ($msg) use ($user) {
                    $msg->to($user->email)->subject('Your OTP Code');
                });
            } else {
                $formattedPhone = $user->phone;
                if (!str_starts_with($formattedPhone, '+')) {
                    $formattedPhone = '+1' . ltrim($formattedPhone, '0'); // default to US code
                }

                $twilio->sendSMS($formattedPhone, "Your OTP is: $otp");
            }

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully.',
                'medium' => $field,
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
            'login_type' => 'required|in:email,phone',
            'value' => 'required|string',
            'otp' => 'required|string',
        ]);

        try {
            $field = $request->login_type;
            $value = $request->value;

            $user = User::where($field, $value)->first();

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
}
