<?php

namespace App\Http\Controllers\api;

use Throwable;
use App\Models\Channel;
use App\Models\Highlight;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $channelIds = Channel::where('streamer_id', $user->id)->pluck('id');

        $highlight = Highlight::with('channel:id,name')
            ->when($request->channel_id, function ($query) use ($request, $channelIds) {
                if ($channelIds->contains($request->channel_id)) {
                    $query->where('channel_id', $request->channel_id);
                }
            })
            ->whereIn('channel_id', $channelIds)
            ->latest()
            ->get();

        // $highlights = $highlights->map(function ($highlight) {
        //     return [
        //         'id'          => $highlight->id,
        //         'channel_id'  => $highlight->channel_id,
        //         'channel' => $highlight->channel->name ?? null,
        //         'title'       => $highlight->title,
        //         'video'   => $highlight->video ? asset('storage/' . $highlight->video) : null,
        //         'thumbnail' => $highlight->thumbnail ? asset('storage/' . $highlight->thumbnail) : null,
        //         'description' => $highlight->description,
        //         'status'      => $highlight->status,
        //         'created_at'  => $highlight->created_at->toDateTimeString(),
        //     ];
        // });

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Highlights fetched successfully.',
        //     'data'    => [
        //         'highlights' => $highlights
        //     ]
        // ]);
        return ApiResponse::success('Highlights fetched successfully.', [
            'highlights' => $highlight->map(function ($item) {
                return ApiResponse::highlightResource($item);
            })
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'channel_id'   => 'required|exists:channels,id',
            'title'        => 'required|string|max:255',
            'video'        => 'required',
            'thumbnail'    => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description'  => 'required|string|max:1000',
        ]);

        DB::beginTransaction();

        try {
            $thumbnailPath = $request->file('thumbnail')?->store('highlights', 'public');
            $videoPath = $request->file('video')?->store('highlights', 'public');

            $highlight = Highlight::create([
                'channel_id' => $request->channel_id,
                'title'      => $request->title,
                'video'      => $videoPath,
                'thumbnail'  => $thumbnailPath,
                'description' => $request->description,
            ]);

            DB::commit();

            return ApiResponse::success('Highlight created successfully.', [
                'highlight' => ApiResponse::highlightResource($highlight)
            ], 201);
        } catch (Throwable $e) {
            DB::rollBack();
            return ApiResponse::error('Failed to create highlight.', $e->getMessage());
        }
    }

    // public function update

    // public function destroy
}
