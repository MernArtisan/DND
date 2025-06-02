<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = 'channels';
    public function streamer()
    {
        return $this->belongsTo(User::class, 'streamer_id');
    }
    public function getThumbnailAttribute()
    {
        $path = $this->banner ?? $this->logo;

        if ($path && file_exists(public_path($path))) {
            return asset($path);
        }

        return asset('default-thumbnail.png'); // put this image in public/
    }

    public function getStreamerAttribute()
    {
        return $this->streamer()->select('id', 'first_name', 'last_name', 'image')->first();
    }
}
