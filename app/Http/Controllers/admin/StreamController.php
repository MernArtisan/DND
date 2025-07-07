<?php

namespace App\Http\Controllers\admin;

use App\Models\Stream;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StreamController extends Controller
{
    public function Stream()
    {
        $streams = Stream::orderBy('id', 'desc')->get();
        $streams_count_live = Stream::where('status', 'live')->count();
        $streams_count_pending = Stream::where('status', 'pending')->count();
        $streams_count_ended = Stream::where('status', 'ended')->count();
        return view('admin.stream.streams', [
            'streams' => $streams,
            'streams_count_live' => $streams_count_live,
            'streams_count_pending' => $streams_count_pending,
            'streams_count_ended' => $streams_count_ended,
        ]);
    }
}
