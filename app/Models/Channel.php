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
   
}
