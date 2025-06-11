<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('web.news.index');
    }
    public function details()
    {
        return view('web.news.details');
    }
}
