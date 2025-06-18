<?php

namespace App\Http\Controllers\api;

use App\Models\Banner;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscoverController extends Controller
{
    public function banners()
    {
        $banners = Banner::where('platform', ['both', 'app'])->get();

        return ApiResponse::success(message: 'Banners fetched successfully.', data: [
            'banners' => $banners
        ]);
    }
}
