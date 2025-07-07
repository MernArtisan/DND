<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UserSubscription;
use App\Models\SubcriptionPayment;
use App\Http\Controllers\Controller;

class DashboardControler extends Controller
{
    public function dashboard()
    {
        $user_subscription_active = UserSubscription::where('is_active', 1)->count();
        $user_subscription_inactive = UserSubscription::where('is_active', 0)->count();
        $user_streamers = User::where('role', 'streamer')->count();
        $channels_count = Channel::count();
        $user_subscriptions = UserSubscription::count();
        $users = User::count();
        $subscription_payments = SubcriptionPayment::all();


        return view('admin.dashboard', [
            'user_subscription_active' => $user_subscription_active,
            'user_subscription_inactive' => $user_subscription_inactive,
            'user_streamers' => $user_streamers,
            'channels_count' => $channels_count,
            'user_subscriptions' => $user_subscriptions,
            'users' => $users,
            'subscription_payments' => $subscription_payments,
        ]);
    }

    public function getChartData(Request $request)
    {
        $query = SubcriptionPayment::query();

        // If no filter applied, default to current month and year
        if (!$request->has('year') && !$request->has('month')) {
            $query->whereYear('payment_date', now()->year)
                ->whereMonth('payment_date', now()->month);
        } else {
            if ($request->filled('year')) {
                $query->whereYear('payment_date', $request->year);
            }
            if ($request->filled('month')) {
                $query->whereMonth('payment_date', $request->month);
            }
        }

        $data = $query->selectRaw("DATE_FORMAT(payment_date, '%b %Y') as month, SUM(amount) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json([
            'labels' => $data->pluck('month'),
            'totals' => $data->pluck('total'),
        ]);
    }
}
