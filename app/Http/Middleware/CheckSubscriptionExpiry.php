<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSubscription;
use Carbon\Carbon;

class CheckSubscriptionExpiry
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $subscription = UserSubscription::where('user_id', Auth::id())
                ->where('is_active', true)
                ->first();

            if ($subscription && Carbon::now()->gt($subscription->end_date)) {
                $subscription->is_active = false;
                $subscription->save();
            }
        }

        return $next($request);
    }
}
/*  */