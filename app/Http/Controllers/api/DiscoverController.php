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
use App\Models\User;
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

        $category = Category::where('name', 'like', "%$query%")->first();

        if ($category) {
            $streams = Stream::where('category_id', $category->id)
                ->get();

            $channels = $streams->pluck('channel')->unique()->values();

            return ApiResponse::success(message: 'Category fetched successfully.', data: [
                'streams' => $streams->map(fn($h) => ApiResponse::transform($h)),
                'channels' => $channels
            ]);
        }

        $streams = Stream::with(['channel', 'category'])
            ->where('title', 'like', "%$query%")
            ->get();

        if ($streams->isNotEmpty()) {
            $channels = $streams->pluck('channel')->unique()->values();
            return ApiResponse::success(message: 'Streams fetched successfully.', data: [
                'streams' => $streams->map(fn($h) => ApiResponse::transform($h)),
                'channels' => $channels
            ]);
        }
        $highlights = Highlight::where('title', 'like', "%$query%")
            ->get();

        if ($highlights->isNotEmpty()) {
            $channels = $streams->pluck('channel')->unique()->values();
            return ApiResponse::success(message: 'Highlights fetched successfully.', data: [
                'highlights' => $highlights->map(fn($h) => ApiResponse::highlightResource($h)),
                // 'channels' => $channels
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No results found'
        ], 404);
    }
}
