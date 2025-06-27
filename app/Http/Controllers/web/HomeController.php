<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('platform', ['both', 'web'])->get();
        // return $banners;
        return view('web.home.index',[
            'banners' => $banners
        ]);
    }
}
