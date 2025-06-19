<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function Updateprofile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|unique:users,phone,' . $user->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'bio' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($user->image && Storage::exists(str_replace('storage/', 'public/', $user->image))) {
                Storage::delete(str_replace('storage/', 'public/', $user->image));
            }
            $path = $request->file('image')->store('users', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $user->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully.',
            'user' => $user
        ]);
    }

    public function profile()
    {
        $user = User::findOrFail(Auth::id());
        return response()->json([
            'status' => true,
            'user' => new UserResource($user),
        ]);
    }

    public function terms()
    {
        $content = Content::where('name', 'terms')->first();
        if (!$content) {
            return response()->json([
                'status' => false,
                'message' => 'Terms and conditions not found',
                'content' => null,
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Terms content fetched successfully',
            'data' => [
                'name' => $content->name,
                'sub_name' => $content->sub_name,
                'description' => $content->description,
            ],
        ]);
    }

    public function privacy()
    {
        $content = Content::where('name', 'privacy')->first();
        if (!$content) {
            return response()->json([
                'status' => false,
                'message' => 'Privacy policy not found',
                'content' => null,
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Privacy content fetched successfully',
            'data' => [
                'name' => $content->name,
                'sub_name' => $content->sub_name,
                'description' => $content->description,
            ],
        ]);
    }

    public function deleteAccount(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated',
            ], 401);
        }
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'Account deleted successfully',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }


    public function updateFcmToken(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'FCM token updated successfully',
        ]);
    }
}
