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
    public function getStreamerAttribute()
    {
        if ($this->banner && file_exists(public_path($this->banner) || file_exists(public_path($this->logo)))) {
            return asset($this->banner ?? $this->logo);
        }

        if ($this->banner || $this->logo) {
            return asset('default-woman.png');
        }
        return asset('default-man.png');
    }
}
