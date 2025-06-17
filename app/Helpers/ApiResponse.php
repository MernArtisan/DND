<?php

namespace App\Helpers;

use App\Models\Stream;
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
            'video'       => asset('storage/' . $highlight->video),
            'thumbnail'   => asset('storage/' . $highlight->thumbnail),
            'description' => $highlight->description,
            'created_at'  => $highlight->created_at,
            'updated_at'  => $highlight->updated_at,
        ];
    }

    public static function transform(Stream $stream): array
    {
        return [
            'id'                => $stream->id,
            'stream_id'         => $stream->stream_id,
            'team_1'            => $stream->team_1,
            'team1_symbol'      => $stream->team1_symbol,
            'team_2'            => $stream->team_2,
            'team2_symbol'      => $stream->team2_symbol,
            'category_id'       => $stream->category_id,
            'title'             => $stream->title,
            'date'              => $stream->date,
            'start_time'        => $stream->start_time,
            'end_time'          => $stream->end_time,
            'location'          => $stream->location,
            'location_symbol'   => $stream->location_symbol,
            'image'         => $stream->image ? asset('storage/' . $stream->image) : null, // 👈 full url
            'description'       => $stream->description,
            'status'            => $stream->status,
            'channel_id'        => $stream->channel_id,
            'created_at'        => $stream->created_at,
            'updated_at'        => $stream->updated_at,
        ];
    }
}
