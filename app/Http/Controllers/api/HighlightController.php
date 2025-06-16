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
        // dd("abc");
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
        $highlights = $highlights->map(function ($highlight) {
            return [
                'id'          => $highlight->id,
                'channel_id'  => $highlight->channel_id,
                'channel' => $highlight->channel->name ?? null,
                'title'       => $highlight->title,
                'video'   => $highlight->video ? asset('storage/' . $highlight->video) : null,
                'thumbnail' => $highlight->thumbnail ? asset('storage/' . $highlight->thumbnail) : null,
                'description' => $highlight->description,
                'status'      => $highlight->status,
                'created_at'  => $highlight->created_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Highlights fetched successfully.',
            'data'    => [
                'highlights' => $highlights
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|exists:channels,id',
            'title'      => 'required|string',
            'video'      => 'required|mimes:mp4,webm,ogg|max:51200',
            'thumbnail'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            // 'status' => 'required',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('storage/highlights', 'public');
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('storage/highlights', 'public');
        }

        $highlight = Highlight::create([
            'channel_id' => $request->channel_id,
            'title' => $request->title,
            'video' => $videoPath,
            'thumbnail' => $thumbnailPath,
            'description' => $request->description,
            // 'status' => $request->status,
        ]);

        $highlight->save();



        return response()->json([
            'success' => true,
            'message' => 'Highlight created successfully.',
            'data'    => [
                'highlight' => $highlight
            ]
        ]);
    }
    // public function update

    // public function destroy
}
