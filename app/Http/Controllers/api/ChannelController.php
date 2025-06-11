<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Channel;
use Exception;
class ChannelController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
 

        try {
            DB::beginTransaction();

            $bannerPath = $request->file('banner')->store('channels', 'public');
            $logoPath = $request->file('logo')->store('channels', 'public');

            $baseSlug = \Illuminate\Support\Str::slug($validated['name']);
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
            $channel->streamer_id = Auth::id();
            $channel->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Channel created successfully.',
                'channel' => $channel
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create channel.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
