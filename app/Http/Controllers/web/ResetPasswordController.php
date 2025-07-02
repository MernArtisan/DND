<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email'); // ya $request->input('email')

        return view('web.auth.reset-password', [
            'token' => $token,
            'email' => $email
        ]);
    }

    public function reset(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8|confirmed',
                'token' => 'required'
            ]);

            $record = DB::table('password_resets')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            if (!$record || Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {

                return back()->with(['error' => 'Token expired or invalid.']);
            }

            User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('login')->with('success', 'Password has been reset.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Something went wrong. Please try again later.']);
        }
    }
}
