<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ApiResponse
{
    public static function success($message = 'Success', $data = [], $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    public static function error($message = 'Something went wrong', $error = null, $code = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error'   => $error,
        ], $code);
    }

    public static function highlightResource($highlight)
    {
        return [
            'id'          => $highlight->id,
            'channel_id'  => $highlight->channel_id,
            'title'       => $highlight->title,
            'video'       => asset('storage/' .$highlight->video),
            'thumbnail'   => asset('storage/' .$highlight->thumbnail),
            'description' => $highlight->description,
            'created_at'  => $highlight->created_at,
            'updated_at'  => $highlight->updated_at,
        ];
    }
}
