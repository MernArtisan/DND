<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use App\Models\Stream;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $content = Content::where('name', 'Terms Condition')->first();
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


    public function updateScoreCard(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'score_card' => 'required',
        ]);

        try {
            // Try to find the stream
            $stream = Stream::findOrFail($id);

            // Update score_card
            $stream->score_card = $request->score_card;
            $stream->save();

            // Return success response
            return response()->json([
                'status'  => true,
                'message' => 'Score card updated successfully.',
                'data'    => $stream
            ]);
        } catch (ModelNotFoundException $e) {
            // Return proper error message if ID not found
            return response()->json([
                'status'  => false,
                'message' => 'Invalid Stream ID. Score card could not be updated.',
            ], 404);
        }
    }

    public function getScoreCard()
    {
        $streams = Stream::where('status', 'live')->get();

        return response()->json([
            'status' => true,
            'message' => 'Live score cards fetched successfully.',
            'data' => $streams
        ]);
    }

    public function checkSubscription($user_id)
    {
        try {
            // Check if user exists
            $user = User::findOrFail($user_id);
            // Check if active subscription exists
            $subscription = UserSubscription::where('user_id', $user_id)
                ->where('is_active', 1)
                ->first();
            return response()->json([
                'status'  => true,
                'message' => 'Subscription status retrieved successfully.',
                'data'    => [
                    'user_id' => $user_id,
                    'subscription_status' => $subscription ? 'paid' : 'unpaid'
                ]
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'User not found.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'An error occurred while checking subscription.',
                'error'   => $e->getMessage() // Optional: Remove in production
            ], 500);
        }
    }
}
