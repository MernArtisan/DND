<?php

namespace App\Http\Controllers\api;

use App\Helpers\StreamHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStreamRequest;
use App\Models\Category;
use App\Services\StreamService;

class StreamController extends Controller
{
    public function __construct(protected StreamService $streamService) {}

    public function category()
    {
        $categories = Category::where('status', 'active')->get();

        $categories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
        return response()->json([
            'success' => true,
            'message' => 'Categories fetched successfully',
            'data' => $categories
        ]);
    }
    public function addStream(StoreStreamRequest $request)
    {
        $stream = $this->streamService->create($request->validated(), $request->file('image'));

        return response()->json([
            'success' => true,
            'message' => 'Stream created successfully',
            'data'    => StreamHelper::transform($stream) // 👈 use helper
        ], 201);
    }
}
