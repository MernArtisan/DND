<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HighlightResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'channel_id' => $this->channel_id,
            'title'      => $this->title,
            'video'      => asset('storage/' . $this->video),
            'thumbnail'  => asset('storage/' . $this->thumbnail),
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
