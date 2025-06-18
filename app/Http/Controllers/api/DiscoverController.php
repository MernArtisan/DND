<?php

namespace App\Http\Controllers\api;

use App\Models\Banner;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Highlight;

class DiscoverController extends Controller
{
    public function banners()
    {
        $banners = Banner::where('platform', ['both', 'app'])->get();

        return ApiResponse::success(message: 'Banners fetched successfully.', data: [
            'banners' => $banners
        ]);
    }

    public function highlightsChannels()
    {
        $highlights = Highlight::orderByDesc('view_count')->inRandomOrder()->take(4)->get();
        $channels = Channel::whereHas('streams', function ($query) {
            $query->where('viewer_count', '>', 0);
        })
            ->get()
            ->sortByDesc(function ($channel) {
                return $channel->streams()->sum('viewer_count'); // direct query, not loaded relation
            })
            ->take(5) // ✅ after sorting
            ->values();


        $topChannels = $channels->take(3);
        return ApiResponse::success(message: 'Highlights fetched successfully.', data: [
            'highlights' => $highlights,
            'channels' => $topChannels
        ]);
    }
}
