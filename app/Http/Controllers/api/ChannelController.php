<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChannelController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $bannerPath = $request->file('banner')->store('channels', 'public');
            $logoPath = $request->file('logo')->store('channels', 'public');

            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $count = 1;
            
            while (Channel::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $channel = new Channel();
            $channel->name = $validated['name'];
            $channel->slug = $slug;
            $channel->description = $validated['description'] ?? null;
            $channel->banner = 'storage/' . $bannerPath;
            $channel->logo = 'storage/' . $logoPath;
            $channel->streamer_id = $user->id;
            $channel->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Channel created successfully.',
                'channel' => [
                    'id' => $channel->id,
                    'name' => $channel->name,
                    'slug' => $channel->slug,
                    'description' => $channel->description,
                    'banner' => asset($channel->banner),
                    'logo' => asset($channel->logo),
                    'streamer_id' => $channel->streamer_id,
                    'created_at' => $channel->created_at,
                    'updated_at' => $channel->updated_at,
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create channel.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
