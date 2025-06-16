<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\StreamHelper;
use App\Services\StreamService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStreamRequest;

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

    public function GetMyChannels()
    {
        $user = Auth::user()->id;

        $channels = \App\Models\Channel::where('streamer_id', $user)->get();

        return response()->json([
            'success' => true,
            'message' => 'Channels fetched successfully',
            'data' => $channels
        ]);
    }
    public function addStream(StoreStreamRequest $request)
    {
        $stream = $this->streamService->create($request->validated(), $request->file('image'));

        return response()->json([
            'success' => true,
            'message' => 'Stream created successfully',
            'data'    => StreamHelper::transform($stream)
        ], 200);
    }

    public function toggleStreamStatus($id)
    {
        try {
            $stream = \App\Models\Stream::findOrFail($id);

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
                return response()->json([
                    'success' => false,
                    'message' => 'Stream is already ended. No further status change allowed.',
                    'data'    => StreamHelper::transform($stream)
                ]);
            }
            $stream->update(['status' => $newStatus]);
            return response()->json([
                'success' => true,
                'message' => "Stream status updated to {$newStatus}",
                'data'    => StreamHelper::transform($stream)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data'    => null
            ]);
        }
    }
}
