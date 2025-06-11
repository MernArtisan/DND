<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function Channels()
    {
        return view('web.channels.index');
    }
}
