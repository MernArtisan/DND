<?php

namespace App\Http\Controllers\api;

use App\Helpers\ApiResponse;
use App\Models\SubcriptionPayment;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionControler extends Controller
{
    public function subscriptionsPlans()
    {
        $userId = Auth::id();

        // Fetch the user's current active subscription (if any)
        $userSubscription = UserSubscription::where('user_id', $userId)
            ->where('is_active', true)
            ->where('end_date', '>=', now())
            ->first();

        // Get all plans and mark which one is currently subscribed by the user
        $plans = SubscriptionPlan::orderBy('created_at', 'desc')->get()->map(function ($plan) use ($userSubscription) {
            return [
                'id' => $plan->id,
                'name' => $plan->name,
                'slug' => $plan->slug,
                'price' => $plan->price,
                'billing_cycle' => $plan->billing_cycle,
                'duration_unit' => $plan->duration_unit,
                'duration_value' => $plan->duration_value,
                'description' => $plan->description,
                'features' => json_decode($plan->features, true), // Convert JSON string to array
                'is_active' => (bool)$plan->is_active,
                'is_user_active_plan' => $userSubscription && $userSubscription->plan_id === $plan->id,
                'created_at' => $plan->created_at,
                'updated_at' => $plan->updated_at
            ];
        });

        return ApiResponse::success(
            message: 'Plans fetched successfully.',
            data: ['plans' => $plans]
        );
    }



    public function subcribeplan(Request $request, $id)
    {
        // ✅ Validate incoming request
        $request->validate([
            'payment_id' => 'nullable|string',
            'amount' => 'required|numeric',
            'status' => 'required|in:success,failed,pending',
        ]);

        // ✅ Fetch the selected plan
        $plan = SubscriptionPlan::findOrFail($id);

        // ✅ Check if user already has an active subscription
        $activeSub = UserSubscription::where('user_id', Auth::id())
            ->where('is_active', true)
            ->where('end_date', '>=', now())
            ->first();

        if ($activeSub) {
            return ApiResponse::error('You already have an active subscription plan. Please cancel or wait for it to expire.');
        }

        // ✅ Create payment record
        $payment = SubcriptionPayment::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'payment_id' => $request->payment_id,
            'amount' => $request->amount,
            'currency' => 'USD',
            'status' => $request->status,
            'payment_date' => now(),
        ]);

        // ✅ Create user subscription if payment was successful
        if ($request->status === 'success') {
            $startDate = now();

            $endDate = match ($plan->billing_cycle) {
                'day' => $startDate->copy()->addHours((int) $plan->duration_unit),
                'month' => $startDate->copy()->addMonth(),
                'annual' => $startDate->copy()->addYear(),
                default => $startDate,
            };


            UserSubscription::create([
                'user_id' => Auth::id(),
                'plan_id' => $plan->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'is_active' => true
            ]);
        }

        // ✅ Final API response
        return ApiResponse::success(
            message: 'Subscription processed successfully.',
            data: [
                'plan' => $plan,
                'payment' => $payment
            ]
        );
    }

    public function GetMySubscription()
    {
        $user = Auth::user();

        $subscription = UserSubscription::with('plan')
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'No subscription found for this user.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'My Subscription',
            'data' => [
                'plan_name' => $subscription->plan->name,
                'start_date' => $subscription->start_date,
                'end_date' => $subscription->end_date,
                'is_active' => $subscription->is_active,
                'price' => $subscription->plan->price,
                'billing_cycle' => $subscription->plan->billing_cycle,
                'features' => json_decode($subscription->plan->features),
            ]
        ]);
    }
}
