<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = UserSubscription::with('user', 'plan')->get();
        // return$subscribers;
        return view('admin.subscribers.index', compact('subscribers'));
    }


    public function details(Request $request)
    {
        try {
            $subscriber = UserSubscription::with(['user', 'plan'])->find($request->id);

            if (!$subscriber) {
                return response()->json(['success' => false, 'message' => 'Subscriber not found']);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'subscriber' => $subscriber,
                    'user' => $subscriber->user,
                    'plan' => $subscriber->plan,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
