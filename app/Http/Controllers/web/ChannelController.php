<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function Channels()
    {
        $channels = Channel::whereHas('streams', function ($q) {
            $q->where('status', 'live');
        })->with(['streams' => function ($q) {
            $q->where('status', 'live');
        }])->get();

        return view('web.channels.index', [
            'channels' => $channels
        ]);
    }
}
