<?php

namespace App\Services;

use App\Models\Channel;
use App\Models\Stream;
use Illuminate\Support\Facades\Auth;

class StreamService
{
    public function create(array $data, $imageFile = null): Stream
    {
        $user = Auth::user();

        $channel = Channel::where('streamer_id', $user->id)->firstOrFail();

        $data['channel_id'] = $channel->id;
        $data['status'] = $data['status'] ?? 'pending';

        if ($imageFile) {
            $data['image'] = $imageFile->store('streams', 'public');
        }

        return Stream::create($data);
    }
}
