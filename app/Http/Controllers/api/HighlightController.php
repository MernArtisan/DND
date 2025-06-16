<?php

namespace App\Http\Controllers\api;

use App\Models\Channel;
use App\Models\Highlight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HighlightController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();
    //     $channelsIds = Channel::where('streamer_id', $user->id)->pluck('id');
    //     $highlights = \App\Models\Highlight::whereIn('channel_id', $channelsIds)->get()->latest()
    //         ->get();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Your highlights fetched successfully.',
    //         'data'    => $highlights
    //     ]);
    // }
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get all your channel IDs
        $channelIds = Channel::where('streamer_id', $user->id)->pluck('id');

        // Get highlights of user's channels, optionally filter by channel_id
        $highlights = Highlight::with('channel:id,name') // only fetch channel name + id
            ->when($request->channel_id, function ($query) use ($request, $channelIds) {
                if ($channelIds->contains($request->channel_id)) {
                    $query->where('channel_id', $request->channel_id);
                }
            })
            ->whereIn('channel_id', $channelIds)
            ->latest()
            ->get();

        // Transform for Flutter
        $data = $highlights->map(function ($highlight) {
            return [
                'id'          => $highlight->id,
                'channel_id'  => $highlight->channel_id,
                'channel' => $highlight->channel->name ?? null,
                'title'       => $highlight->title,
                'video_url'   => $highlight->video ? asset('storage/' . $highlight->video) : null,
                'thumbnail_url' => $highlight->thumbnail ? asset('storage/' . $highlight->thumbnail) : null,
                'description' => $highlight->description,
                'status'      => $highlight->status,
                'created_at'  => $highlight->created_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Highlights fetched successfully.',
            'data'    => $data,
        ]);
    }

    public function store(Request   $request){
        $request->validate([
            'channel_id' => 'required|exists:channels,id',
            'title' => 'required|string',
            'video' => 'required|string|MP4',
            'thumbnail' => 'required|string|',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);
    }
    // public function update

    // public function destroy
}
