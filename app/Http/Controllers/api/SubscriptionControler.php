<?php

namespace App\Http\Controllers\api;

use App\Helpers\ApiResponse;
use App\Models\SubcriptionPayment;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriptionControler extends Controller
{
    public function subscriptionsPlans()
    {
        $plans = SubscriptionPlan::orderBy('created_at', 'desc')->get()->map(function ($plan) {
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
                'created_at' => $plan->created_at,
                'updated_at' => $plan->updated_at
            ];
        });

        return ApiResponse::success(
            message: 'Plans fetched successfully.',
            data: ['plans' => $plans]
        );
    }

    public function subscriptionPlan(Request $request, $id)
    {
        $request->validate([
            'payment_id' => 'nullable|string',
            'amount' => 'required|numeric',
            'status' => 'required|in:success,failed,pending',
        ]);

        $plan = SubscriptionPlan::findOrFail($id);

        // Create payment record
        $payment = SubcriptionPayment::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'payment_id' => $request->payment_id,
            'amount' => $request->amount,
            'currency' => 'USD',
            'status' => $request->status,
            'payment_date' => now(),
        ]);

        return ApiResponse::success(
            message: 'Subscription processed successfully.',
            data: [
                'plan' => $plan,
                'payment' => $payment
            ]
        );
    }
}
