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
    public function streams()
    {
        return $this->hasMany(Stream::class);
    }

    public function highlights()
    {
        return $this->hasMany(Highlight::class);
    }

    public function getBannerAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getLogoAttribute($value)
    {
        return $value ? asset($value) : null;
    }
}
