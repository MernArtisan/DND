<?php

namespace App\Http\Controllers\web;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $terms = Content::findOrFail(2);
        return view('web.discover.terms', [
            'terms' => $terms
        ]);
    }

    public function privacy()
    {
        $privacy = Content::findOrFail(1);
        return view('web.discover.privacy', [
            'privacy' => $privacy
        ]);
    }
}
