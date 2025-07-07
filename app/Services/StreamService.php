<?php

namespace App\Services;

use App\Models\Channel;
use App\Models\Stream;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\User;

class StreamService
{
    // public function create(array $data, $imageFile = null): Stream
    // {
    //     $user = Auth::user();


    //     $channel = Channel::where('id', $data['channel_id'])
    //         ->where('streamer_id', $user->id)
    //         ->first();

    //     if (!$channel) {
    //         throw new \Exception("Channel not found or doesn't belong to this user.");
    //     }

    //     $data['status'] = $data['status'] ?? 'pending';
    //     if ($imageFile) {
    //         $data['image'] = $imageFile->store('streams', 'public');
    //     }

    //     return Stream::create($data);
    // }

    public function create(array $data, $imageFile = null): Stream
    {
        $user = Auth::user();

        $channel = Channel::where('id', $data['channel_id'])
            ->where('streamer_id', $user->id)
            ->first();

        if (!$channel) {
            throw new \Exception("Channel not found or doesn't belong to this user.");
        }

        $data['status'] = $data['status'] ?? 'pending';

        if ($imageFile) {
            $data['image'] = $imageFile->store('streams', 'public');
        }

        $stream = Stream::create($data);

        // 🔁 Send notification to all users
        $allUsers = User::where('role', 'user')->get(); // Adjust role check if needed
        foreach ($allUsers as $u) {
            Notification::create([
                'user_id' => $u->id,
                'message' => 'New stream ' . $stream->title,
                'seen' => false,
            ]);
        }

        return $stream;
    }
}
