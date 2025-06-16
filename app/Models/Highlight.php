<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $fillable = [
        'channel_id',
        'title',
        'video',
        'thumbnail',
        'description',
        'status'
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
