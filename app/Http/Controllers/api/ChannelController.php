<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Channel;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChannelController extends Controller
{

    public function index()
    {
        $user = Auth::user()->id;

        $channels = Channel::where('streamer_id', $user)->get();

        return response()->json([
            'success' => true,
            'message' => 'Channels fetched successfully',
            'data' => $channels
        ]);
    }
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

    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $channel = Channel::where('streamer_id', $userId)->where('id', $id)->firstOrFail();

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('banner')) {
                if ($channel->banner && Storage::disk('public')->exists($channel->banner)) {
                    Storage::disk('public')->delete($channel->banner);
                }
                $bannerPath = $request->file('banner')->store('channels/banners', 'public');
                $channel->banner = $bannerPath;
            }

            if ($request->hasFile('logo')) {
                if ($channel->logo && Storage::disk('public')->exists($channel->logo)) {
                    Storage::disk('public')->delete($channel->logo);
                }
                $logoPath = $request->file('logo')->store('channels/logos', 'public');
                $channel->logo = $logoPath;
            }

            if ($channel->name !== $validated['name']) {
                $baseSlug = Str::slug($validated['name']);
                $slug = $baseSlug;
                $count = 1;

                while (Channel::where('slug', $slug)->where('id', '!=', $channel->id)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }

                $channel->slug = $slug;
            }

            $channel->name = $validated['name'];
            $channel->description = $validated['description'] ?? null;
            $channel->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Channel updated successfully.',
                'channel' => [
                    'id'          => $channel->id,
                    'name'        => $channel->name,
                    'slug'        => $channel->slug,
                    'description' => $channel->description,
                    'banner'      => $channel->banner,
                    'logo'        => $channel->logo,
                ]
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to update channel.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        $userId = Auth::id();

        $channel = Channel::where('id', $id)
            ->where('streamer_id', $userId)
            ->firstOrFail();

        try {
            DB::beginTransaction();

            // Delete banner & logo if they exist
            if ($channel->banner && Storage::disk('public')->exists($channel->banner)) {
                Storage::disk('public')->delete($channel->banner);
            }

            if ($channel->logo && Storage::disk('public')->exists($channel->logo)) {
                Storage::disk('public')->delete($channel->logo);
            }

            $channel->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Channel deleted successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete channel.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
