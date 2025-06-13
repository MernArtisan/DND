<?php

namespace App\Http\Controllers\api;

use App\Helpers\StreamHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStreamRequest;
use App\Services\StreamService;

class StreamController extends Controller
{
    public function __construct(protected StreamService $streamService) {}

    public function addStream(StoreStreamRequest $request)
    {
        // $request->validate([
        //     'stream_id' => 'required|unique:streams,stream_id',
        //     'team_1' => 'required|string',
        //     'team_2' => 'required|string',
        //     'category_id' => 'required|exists:categories,id',
        //     'title' => 'required|string',
        //     'date' => 'required|date',
        //     'start_time' => 'required',
        //     'end_time' => 'required',
        //     'location' => 'nullable|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        //     'description' => 'nullable|string',
        //     'status' => 'nullable|in:pending,live,ended'
        // ]);

        // $user = \Illuminate\Support\Facades\Auth::user();

        // $channel = \App\Models\Channel::where('streamer_id', $user->id)->first();
        // if (!$channel) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Channel not found for this user.'
        //     ], 400);
        // }

        // $imagePath = null;
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('streams', 'public');
        // }

        // $stream = \App\Models\Stream::create([
        //     'stream_id' => $request->stream_id,
        //     'team_1' => $request->team_1,
        //     'team_2' => $request->team_2,
        //     'category_id' => $request->category_id,
        //     'channel_id' => $channel->id,
        //     'title' => $request->title,
        //     'date' => $request->date,
        //     'start_time' => $request->start_time,
        //     'end_time' => $request->end_time,
        //     'location' => $request->location,
        //     'image' => $imagePath,
        //     'description' => $request->description,
        //     'status' => $request->status ?? 'pending'
        // ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Stream created successfully',
        //     'data' => $stream
        // ], 201);
        $stream = $this->streamService->create($request->validated(), $request->file('image'));

        return response()->json([
            'success' => true,
            'message' => 'Stream created successfully',
            'data'    => StreamHelper::transform($stream) // 👈 use helper
        ], 201);
    }
}
