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
        return view('admin.stream.streams', compact('streams'));
    }
}
