<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use App\Models\Like;
use App\Models\Banner;
use App\Models\Stream;
use App\Models\Unlike;
use App\Models\Channel;
use App\Models\Highlight;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\User;
// 
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

        return ApiResponse::success('My saved videos fetched successfully.', [
            'savedVideos' => $savedHighlights->map(function ($item) {
                return ApiResponse::highlightResource($item);
            })
        ]);
    }


    public function incrementHighlightView(Request $request)
    {
        $request->validate([
            'highlight_id' => 'required|exists:highlights,id',
        ]);

        $highlight = Highlight::find($request->highlight_id);

        $highlight->increment('view_count');

        return ApiResponse::success('Highlight view count incremented successfully.');
    }

    public function hightlightsSpecific($id)
    {
        // Retrieve the highlight by its ID along with comments and likes
        $highlight = Highlight::with(['comments.user', 'likes.user'])->find($id);

        // Check if the highlight exists
        if (!$highlight) {
            return ApiResponse::error('Highlight not found.', [], 404);
        }

        // Check if the current user has liked this highlight
        $liked = $highlight->likes->where('user_id', Auth::id())->first();
        $liked = $liked ? true : false;  // Check if the current user has liked this highlight and set it to true/false

        $unliked = $highlight->unlike->where('user_id', Auth::id())->first();
        $unliked = $unliked ? true : false;

        // Prepare the comments data
        $comments = $highlight->comments->map(function ($comment) {
            return [
                'id' => $comment->user->id,
                'user' => $comment->user->name,  // User name who commented
                'role' => $comment->user->role,  // User's role who commented
                'image' => $comment->user->image,  // User's image who commented
                'comment' => $comment->comment,  // The content of the comment
                'created_at' => $comment->created_at, // Date of the comment
            ];
        });

        // Check if the current user has saved this highlight
        $saved = DB::table('saved_highlights')
            ->where('user_id', Auth::id())
            ->where('highlight_id', $id)
            ->exists();

        // Prepare the likes data, if the user liked this highlight, include the type
        $likesData = ['liked' => $liked]; // Basic liked status

        if ($liked) {
            // If the user liked, include the type of the like
            $likesData['type'] = $highlight->likes->where('user_id', Auth::id())->first()->type;
        }

        // Return the response with the simplified structure
        return ApiResponse::success('Highlights fetched successfully.', [
            'highlight' => [
                'id' => $highlight->id,
                'channel_id' => $highlight->channel_id,
                'title' => $highlight->title,
                'video' => asset('storage/' . $highlight->video),  // Assuming the video is stored in the 'storage' folder
                'thumbnail' => asset('storage/' . $highlight->thumbnail),  // Assuming the thumbnail is stored in the 'storage' folder

                'description' => $highlight->description,
                'created_at' => $highlight->created_at,
                'commentCount' => $highlight->comments->count(),
                'likeCount' => $highlight->likes->count(),
                'unlikeCount' => $highlight->unlike->count(),
                'shareCount' => $highlight->share_count,
                'viewCount' => $highlight->view_count,
                'liked' => $likesData['liked'],  // liked status (true/false)
                'unliked' => $unliked,
                'type' => $likesData['type'] ?? null,  // The type of like if liked is true, otherwise null
                'saved' => $saved,  // saved status (true/false)
            ],
            'comments' => $comments,  // Return the comments
        ]);
    }


    public function addComment(Request $request, $id)
    {
        $request->validate([
            'comment'      => 'required|string',
        ]);

        $highlight = Highlight::find($id);

        $highlight->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return ApiResponse::success('Comment added successfully.');
    }

    public function likeUnlikeHighlight($id, Request $request)
    {
        // Validate the reaction type input (for liking)
        $validated = $request->validate([
            'type' => 'nullable|string|in:like,love,haha,wow,sad,angry', // Reaction types (for liking)
        ]);

        // Find the highlight
        $highlight = Highlight::find($id);

        if (!$highlight) {
            return ApiResponse::error('Highlight not found.', [], 404);
        }

        // Check if the user has already liked this highlight
        $existingLike = Like::where('highlight_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingLike) {
            // If the user has already liked, remove the like (delete the like record)
            $existingLike->delete();

            return ApiResponse::success('You have unliked the highlight.');
        } else {
            // If the user hasn't liked yet, like the highlight and save the reaction type in the `likes` table
            $like = new Like();
            $like->highlight_id = $id;
            $like->user_id = Auth::id();  // Get the logged-in user's ID
            $like->type = $validated['type'];  // Save the reaction type (like, love, etc.)
            $like->save();

            return ApiResponse::success('You have liked the highlight.', [
                'reaction_type' => $validated['type'],  // Returning the reaction type for the like
            ]);
        }
    }


    public function unlikeHighlight($id)
    {
        $highlight = Highlight::find($id);

        if (!$highlight) {
            return ApiResponse::error('Highlight not found.', [], 404);
        }

        $existingLike = Like::where('highlight_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingLike) {
            $existingLike->delete();

            $unlike = new Unlike();
            $unlike->highlight_id = $id;
            $unlike->user_id = Auth::id();
            $unlike->save();

            return ApiResponse::success('You have unliked the highlight.');
        } else {
            $existingUnlike = Unlike::where('highlight_id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingUnlike) {
                $existingUnlike->delete();
                return ApiResponse::success('unlike removed successfully.');
            } else {
                $unlike = new Unlike();
                $unlike->highlight_id = $id;
                $unlike->user_id = Auth::id();
                $unlike->save();

                return ApiResponse::success('You have unliked the highlight.');
            }
        }
    }

    public function shareHighlight(Request $request)
    {
        $request->validate([
            'highlight_id' => 'required|exists:highlights,id',
        ]);

        $highlight = Highlight::find($request->highlight_id);

        $highlight->increment('share_count');

        return ApiResponse::success('Highlight shared successfully.');
    }






    public function SearchTerm(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->input('query');
        $response = [];

        // 1. Search Categories and get their streams & channels
        $categories = Category::where('name', 'like', "%$query%")->get();
        foreach ($categories as $category) {
            // Get LIVE streams for this category
            $streams = Stream::with('channel')
                ->where('category_id', $category->id)
                ->where('status', 'live')
                ->get();

            // Get unique channels from these streams
            $channels = $streams->pluck('channel')->unique()->values();

            // Add streams to response
            foreach ($streams as $stream) {
                $response[] = [
                    'id' => $stream->id,
                    'name' => $stream->title,
                    'status' => $stream->status,
                    'image' => asset($stream->image),
                    'description' => $stream->description,
                    'type' => 'stream',
                    'channel_id' => $stream->channel->id,
                    'channel_name' => $stream->channel->name
                ];
            }

            // Add channels to response
            foreach ($channels as $channel) {
                $response[] = [
                    'id' => $channel->id,
                    'name' => $channel->name,
                    'image' => asset($channel->logo),
                    'is_active' => $channel->is_active,
                    'description' => $channel->description,
                    'type' => 'channel'
                ];
            }
        }

        // 2. Search Streams (excluding those from category search)
        $streamIdsFromCategories = collect($response)
            ->where('type', 'stream')
            ->pluck('id')
            ->toArray();

        $streams = Stream::with('channel')
            ->where('title', 'like', "%$query%")
            ->whereNotIn('id', $streamIdsFromCategories)
            ->get();

        foreach ($streams as $stream) {
            $response[] = [
                'id' => $stream->id,
                'name' => $stream->title,
                'status' => $stream->status,
                'image' => asset('storage/' . $stream->image),
                'description' => $stream->description,
                'type' => 'stream',
                'channel_id' => $stream->channel->id,
                'channel_name' => $stream->channel->name
            ];
        }

        // 3. Search Channels (excluding those from category search)
        $channelIdsFromCategories = collect($response)
            ->where('type', 'channel')
            ->pluck('id')
            ->toArray();

        $channels = Channel::where('is_active', 1)
            ->where('name', 'like', "%$query%")
            ->whereNotIn('id', $channelIdsFromCategories)
            ->get();

        foreach ($channels as $channel) {
            $response[] = [
                'id' => $channel->id,
                'name' => $channel->name,
                'image' => asset($channel->logo),
                'is_active' => $channel->is_active,
                'type' => 'channel'
            ];
        }

        // 4. Search Highlights
        $highlights = Highlight::with('channel')
            ->where('title', 'like', "%$query%")
            ->get();

        foreach ($highlights as $highlight) {
            $response[] = [
                'id' => $highlight->id,
                'name' => $highlight->title,
                'image' => asset('storage/' . $highlight->thumbnail),
                'description' => $highlight->description,
                'type' => 'highlight',
                'channel_id' => $highlight->channel->id,
                'channel_name' => $highlight->channel->name
            ];
        }

        if (!empty($response)) {
            return response()->json([
                'success' => true,
                'message' => 'Search results fetched successfully',
                'data' => $response
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No results found'
        ], 404);
    }


    // public function filterData(Request $request)
    // {
    //     $request->validate([
    //         'channel_id' => 'nullable|integer|exists:channels,id',
    //         'highlight' => 'nullable|boolean',
    //         'status' => 'nullable|in:live'
    //     ]);

    //     $response = [];

    //     // 1. Get LIVE streams (filter by channel if provided)
    //     $streamQuery = Stream::with('channel')
    //         ->where('status', 'live')
    //         ->orderBy('created_at', 'desc');

    //     if ($request->has('channel_id')) {
    //         $streamQuery->where('channel_id', $request->channel_id);
    //     }

    //     foreach ($streamQuery->get() as $stream) {
    //         $response[] = [
    //             'id' => $stream->id,
    //             'name' => $stream->title,
    //             'status' => $stream->status,
    //             'image' => asset('storage/'.$stream->image),
    //             'description' => $stream->description,
    //             'type' => 'stream',
    //             'channel_id' => $stream->channel->id,
    //             'channel_name' => $stream->channel->name
    //         ];
    //     }

    //     // 2. Get channels (filter by ID if provided)
    //     $channelQuery = $request->has('channel_id')
    //         ? Channel::where('id', $request->channel_id)
    //         : Channel::query();

    //     foreach ($channelQuery->where('is_active', 1)->get() as $channel) {
    //         $response[] = [
    //             'id' => $channel->id,
    //             'name' => $channel->name,
    //             'image' => asset($channel->logo),
    //             'is_active' => $channel->is_active,
    //             'description' => $channel->description,
    //             'type' => 'channel'
    //         ];
    //     }

    //     // 3. Get highlights if requested
    //     if ($request->boolean('highlight')) {
    //         foreach (
    //             Highlight::with('channel')
    //                 ->orderBy('created_at', 'desc')
    //                 ->get() as $highlight
    //         ) {
    //             $response[] = [
    //                 'id' => $highlight->id,
    //                 'name' => $highlight->title,
    //                 'image' => asset('storage/' . $highlight->thumbnail),
    //                 'description' => $highlight->description,
    //                 'type' => 'highlight',
    //                 'channel_id' => $highlight->channel->id,
    //                 'channel_name' => $highlight->channel->name
    //             ];
    //         }
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Filter results fetched successfully',
    //         'data' => $response
    //     ]);
    // }

    public function filterData(Request $request)
    {
        $request->validate([
            'channel_id' => 'nullable|string', // Changed to string to accept comma-separated values
            'highlight' => 'nullable|boolean',
            'status' => 'nullable|in:live'
        ]);

        $response = [];

        // Convert channel_id to array if provided
        $channelIds = $request->has('channel_id')
            ? explode(',', $request->channel_id)
            : [];

        // 1. Get LIVE streams (filter by channels if provided)
        $streamQuery = Stream::with('channel')
            ->where('status', 'live')
            ->orderBy('created_at', 'desc');

        if (!empty($channelIds)) {
            $streamQuery->whereIn('channel_id', $channelIds);
        }
        foreach ($streamQuery->get() as $stream) {
            $response[] = [
                'id' => $stream->id,
                'name' => $stream->title,
                'status' => $stream->status,
                'image' => asset('storage/' . $stream->image),
                'description' => $stream->description,
                'type' => 'stream',
                'channel_id' => $stream->channel->id,
                'channel_name' => $stream->channel->name
            ];
        }

        // 2. Get channels (filter by IDs if provided)
        $channelQuery = Channel::where('is_active', 1);

        if (!empty($channelIds)) {
            $channelQuery->whereIn('id', $channelIds);
        }

        foreach ($channelQuery->get() as $channel) {
            $response[] = [
                'id' => $channel->id,
                'name' => $channel->name,
                'image' => asset($channel->logo),
                'is_active' => $channel->is_active,
                'description' => $channel->description,
                'type' => 'channel'
            ];
        }

        // 3. Get highlights if requested (filter by channels if provided)
        if ($request->boolean('highlight')) {
            $highlightQuery = Highlight::with('channel')
                ->orderBy('created_at', 'desc');

            if (!empty($channelIds)) {
                $highlightQuery->whereIn('channel_id', $channelIds);
            }

            foreach ($highlightQuery->get() as $highlight) {
                $response[] = [
                    'id' => $highlight->id,
                    'name' => $highlight->title,
                    'image' => asset('storage/' . $highlight->thumbnail),
                    'description' => $highlight->description,
                    'type' => 'highlight',
                    'channel_id' => $highlight->channel->id,
                    'channel_name' => $highlight->channel->name
                ];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Filter results fetched successfully',
            'data' => $response
        ]);
    }



    public function getSpecificChannel($id)
    {
        $channel = Channel::where('id', $id)->first();
        $highlight = Highlight::where('channel_id', $id)->get();
        $streams = Stream::where('channel_id', $id)->get();
        if (!$channel) {
            return response()->json([
                'success' => false,
                'message' => 'Channel not found',
            ], 404);
        }
        return ApiResponse::success(message: 'Channel fetched successfully.', data: [
            'channel' => $channel,
            'highlight' => $highlight->map(fn($h) => ApiResponse::highlightResource($h)),
            'streams' => $streams->map(fn($h) => ApiResponse::transform($h)),
        ]);
    }

    public function getSpecificStream($id)
    {
        $stream = Stream::where('id', $id)->first();
        if (!$stream) {
            return response()->json([
                'success' => false,
                'message' => 'Stream not found',
            ], 404);
        }
        return ApiResponse::success(message: 'Stream fetched successfully.', data: [
            'stream' => ApiResponse::transform($stream),
        ]);
    }


    
}
