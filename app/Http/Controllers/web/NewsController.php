<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $admin = User::where('role', 'admin')->first();
        $articles = Article::with('images')->latest()->get();
        return view('web.news.index', compact('articles', 'admin'));
    }
    public function details($slug)
    {
        $article = Article::with('images')->where('slug', $slug)->firstOrFail();
        $admin = User::where('role', 'admin')->first();
        // return $article;
        return view('web.news.details', compact('article', 'admin'));
    }
}
