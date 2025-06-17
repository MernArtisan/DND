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
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'channel_id'   => 'nullable|exists:channels,id',
            'title'        => 'nullable|string|max:255',
            'video'        => 'nullable',
            'thumbnail'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description'  => 'nullable|string|max:1000',
        ]);

        $highlight = Highlight::findOrFail($id);
        DB::beginTransaction();
        try {
            if ($request->hasFile('thumbnail')) {
                Storage::disk('public')->delete($highlight->thumbnail);
                $highlight->thumbnail = $request->file('thumbnail')->store('highlights', 'public');
            }

            if ($request->hasFile('video')) {
                Storage::disk('public')->delete($highlight->video);
                $highlight->video = $request->file('video')->store('highlights', 'public');
            }

            $highlight->channel_id = $request->channel_id ?? $highlight->channel_id;
            $highlight->title      = $request->title ?? $highlight->title;
            $highlight->description = $request->description ?? $highlight->description;

            $highlight->save();

            DB::commit();

            return ApiResponse::success('Highlight updated successfully.', [
                'highlight' => ApiResponse::highlightResource($highlight)
            ]);
        } catch (Throwable $e) {
            DB::rollBack();
            return ApiResponse::error('Failed to update highlight.', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $highlight = Highlight::findOrFail($id);

        DB::beginTransaction();

        try {
            if ($highlight->thumbnail) {
                Storage::disk('public')->delete($highlight->thumbnail);
            }

            if ($highlight->video) {
                Storage::disk('public')->delete($highlight->video);
            }

            $highlight->delete();

            DB::commit();

            return ApiResponse::success('Highlight deleted successfully.');
        } catch (Throwable $e) {
            DB::rollBack();
            return ApiResponse::error('Failed to delete highlight.', $e->getMessage());
        }
    }


    // public function destroy
}
