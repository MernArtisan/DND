<?php

namespace App\Http\Controllers\api;

use App\Models\Banner;
use App\Models\Stream;
use App\Models\Channel;
use App\Models\Highlight;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $highlight = Highlight::orderByDesc('view_count')->inRandomOrder()->take(4)->get();

        $channels = Channel::where('is_active', 1)
            ->whereHas('streams', function ($query) {
                $query->where('viewer_count', '>', 0);
            })
            ->get()
            ->sortByDesc(function ($channel) {
                return $channel->streams()->sum('viewer_count');
            })
            ->take(5)
            ->values();

        $topChannels = $channels->take(3);

        return ApiResponse::success(message: 'Highlights fetched successfully.', data: [
            'highlight' => $highlight->map(fn($h) => ApiResponse::highlightResource($h)),
            'channels' => $topChannels
        ]);
    }



    public function hightlightsAll()
    {
        $highlight = Highlight::orderBy('created_at', 'desc')->get();

        return ApiResponse::success(message: 'Highlights fetched successfully.', data: [
            'highlight' => $highlight->map(fn($h) => ApiResponse::highlightResource($h)),
        ]);
    }

    public function liveStreams()
    {
        $LiveStreams = Stream::where('status', 'live')->get();

        return ApiResponse::success(message: 'Live Streams fetched successfully.', data: [
            'streams' => $LiveStreams->map(fn($h) => ApiResponse::transform($h)),
        ]);
    }

    public function channelsAll()
    {
        $channels = Channel::where('is_active', 1)->get();

        return ApiResponse::success(message: 'Channels fetched successfully.', data: [
            'channels' => $channels
        ]);
    }


    public function saveVideo(Request $req)
    {
        $req->validate([
            'highlight_id' => 'required|exists:highlights,id',
        ]);

        $alreadySaved = DB::table('saved_highlights')
            ->where('user_id', Auth::id())
            ->where('highlight_id', $req->highlight_id)
            ->first();

        if ($alreadySaved) {
            DB::table('saved_highlights')
                ->where('user_id', Auth::id())
                ->where('highlight_id', $req->highlight_id)
                ->delete();

            return ApiResponse::success('Highlight removed successfully.');
        }

        DB::table('saved_highlights')->insert([
            'user_id' => Auth::id(),
            'highlight_id' => $req->highlight_id,
            'saved_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return ApiResponse::success('Highlight saved successfully.');
    }

    public function getMySavedVideos()
    {
        $user = auth()->user();

        $savedHighlights = $user->savedHighlights()->latest('saved_at')->get();

        return ApiResponse::success('Highlights fetched successfully.', [
            'highlights' => $savedHighlights->map(function ($item) {
                return ApiResponse::highlightResource($item);
            })
        ]);
    }
}
