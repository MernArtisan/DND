<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function corporateSponsors()
    {
        return view('web.discover.corporateSponsors');
    }

    public function liveStreams()
    {
        return view('web.discover.liveStreams');
    }

    public function terms()
    {
        return view('web.discover.terms');
    }

    public function privacy()
    {
        return view('web.discover.privacy');
    }
}
