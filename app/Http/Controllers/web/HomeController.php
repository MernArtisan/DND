<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Stream;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('platform', ['both', 'web'])->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $articals = Article::with('images')->get();
        $streamsLive = Stream::with('channel')->where('status', 'live')->get();
        $streamsPending = Stream::with('channel')
            ->where('status', 'pending')
            ->whereDate('date', '>', Carbon::today())
            ->get()
            ->groupBy(function ($stream) {
                return Carbon::parse($stream->date)->format('l');
            });
        $categoryIds = Stream::where('status', 'live')
            ->pluck('category_id')
            ->unique();
        $streamsGrouped = [];
        foreach ($categoryIds as $catId) {
            $streamsGrouped[$catId] = Stream::with(['channel', 'category']) // add category relationship
                ->where('status', 'live')
                ->where('category_id', $catId)
                ->orderByDesc('viewer_count')
                ->first();
        }
        $categories = Category::whereIn('id', array_keys($streamsGrouped))->get()->keyBy('id');
        return view('web.home.index', [
            'banners' => $banners,
            'testimonials' => $testimonials,
            'articals' => $articals,
            'streamsLive' => $streamsLive,
            'streamsPending' => $streamsPending,
            'streamsGrouped' => $streamsGrouped,
            'categories' => $categories
        ]);
    }
}
