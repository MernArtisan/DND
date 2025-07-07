<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\Stream;
use App\Models\Category;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
// use App\Helpers\StreamHelper;
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
            ->get();

        // Transform each stream in the collection
        $formattedStreams = $topStreams->map(function ($stream) {
            return [
                'id' => $stream->id,
                'stream_id' => $stream->stream_id,
                'team_1' => $stream->team_1,
                'team1_symbol' => $stream->team1_symbol,
                'team_2' => $stream->team_2,
                'team2_symbol' => $stream->team2_symbol,
                'category_id' => $stream->category_id,
                'channel_id' => $stream->channel_id,
                'title' => $stream->title,
                'date' => $stream->date,
                'start_time' => $stream->start_time,
                'end_time' => $stream->end_time,
                'location' => $stream->location,
                'location_symbol' => $stream->location_symbol,
                'image' => asset('storage/' . $stream->image), // Uncommented
                'description' => $stream->description,
                'viewer_count' => $stream->viewer_count,
                'status' => $stream->status,
                'created_at' => $stream->created_at,
                'updated_at' => $stream->updated_at
            ];
        });

        return ApiResponse::success('Top 5 streams fetched successfully.', [
            'streams' => $formattedStreams
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

        // dd($channelIds);
        $stream = Stream::where('status', 'live')
            ->inRandomOrder()
            ->take(3)->get();

        return ApiResponse::success('My streams fetched successfully.', [
            'stream' => $stream->map([ApiResponse::class, 'transform']),
            'channels' => $channels
        ]);
    }
}
