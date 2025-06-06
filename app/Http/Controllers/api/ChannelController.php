<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            \Illuminate\Support\Facades\DB::beginTransaction();

            $bannerPath = $request->file('banner')->store('channels', 'public');
            $logoPath = $request->file('logo')->store('channels', 'public');

            $baseSlug = \Illuminate\Support\Str::slug($validated['name']);
            $slug = $baseSlug;
            $count = 1;

            while (\App\Models\Channel::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $channel = new \App\Models\Channel();
            $channel->name = $validated['name'];
            $channel->slug = $slug;
            $channel->description = $validated['description'] ?? null;
            $channel->banner = 'storage/' . $bannerPath;
            $channel->logo = 'storage/' . $logoPath;
            $channel->streamer_id = $user->id;
            $channel->save();

            \Illuminate\Support\Facades\DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Channel created successfully.',
                'channel' => $channel
            ]);
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create channel.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
