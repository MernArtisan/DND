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


    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_highlights')->withTimestamps()->withPivot('saved_at');
    }


    public function comments()
    {
        return $this->hasMany(HighlightComment::class, 'highlight_id');
    }

    // A highlight has many likes
    public function likes()
    {
        return $this->hasMany(Like::class, 'highlight_id');
    }

    public function unlike()
    {
        return $this->hasMany(Unlike::class, 'highlight_id');
    }
}
