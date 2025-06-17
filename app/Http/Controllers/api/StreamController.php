<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\Stream;
use App\Models\Category;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Helpers\StreamHelper;
use App\Services\StreamService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStreamRequest;
use App\Models\Channel;

class StreamController extends Controller
{
    public function __construct(protected StreamService $streamService) {}

    public function category()
    {
        $categories = Category::where('status', 'active')->get();

        $categories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
        return response()->json([
            'success' => true,
            'message' => 'Categories fetched successfully',
            'data' => $categories
        ]);
    }


    public function addStream(StoreStreamRequest $request)
    {
        $stream = $this->streamService->create($request->validated(), $request->file('image'));

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Stream created successfully',
        //     'data'    => ApiResponse::transform($stream)
        // ], 200);

        return ApiResponse::success('Stream created successfully.', [
            'stream' => ApiResponse::transform($stream)
        ]);
    }

    public function toggleStreamStatus($id)
    {
        try {
            $stream = Stream::findOrFail($id);

            $user = Auth::user();
            if ($stream->channel->streamer_id !== $user->id) {
                abort(403, 'Unauthorized action on this stream');
            }

            $currentStatus = $stream->status;
            $newStatus = null;

            if ($currentStatus === 'pending') {
                $newStatus = 'live';
            } elseif ($currentStatus === 'live') {
                $newStatus = 'ended';
            } elseif ($currentStatus === 'ended') {
                return ApiResponse::error('Stream is already ended. No further status change allowed.', [
                    'stream' => ApiResponse::transform($stream)
                ]);
            }
            $stream->update(['status' => $newStatus]);

            return ApiResponse::success("Stream status updated to {$newStatus}", [
                'stream' => ApiResponse::transform($stream)
            ]);
        } catch (Exception $e) {
            return ApiResponse::error('Something went wrong', $e->getMessage());
        }
    }

    public function topStreams()
    {
        $topStreams = Stream::orderByDesc('viewer_count')
            ->take(5)
            ->select('id', 'stream_id', 'title', 'viewer_count', 'status')
            ->get();

        return ApiResponse::success('Top 5 streams fetched successfully.', [
            'streams' => $topStreams
        ]);
    }

    public function incrementViewer($id)
    {
        $stream = Stream::findOrFail($id);
        $stream->increment('viewer_count');

        return ApiResponse::success('Viewer count updated.', [
            'stream_id'     => $stream->id,
            'viewer_count'  => $stream->viewer_count,
        ]);
    }


    public function myStreams()
    {
        $channelIds = Channel::where('streamer_id', Auth::id())->pluck('id');

        $stream = Stream::whereIn('channel_id', $channelIds)->get();

        return ApiResponse::success('My streams fetched successfully.', [
            'stream' => $stream->map([ApiResponse::class, 'transform'])
        ]);
    }

    public function discoverStreamWithChannels()
    {
        $userId = Auth::id();
 
        $channels = Channel::where('streamer_id', '!=', $userId)->get();
 
        $channelIds = $channels->pluck('id')->toArray();

        // dd($channelIds);
        $randomStream = Stream::with('channel') 
            ->where('status', 'live')
            ->take(2)
            ->first();
// return $randomStream;
        return ApiResponse::success('Random live stream and related channels.', [
            'stream'   => $randomStream ? ApiResponse::transform($randomStream) : null,
            'channels' => $channels
        ]);
    }
}
