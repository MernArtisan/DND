<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    public function highlight()
    {
        return $this->belongsTo(Highlight::class);
    }

    // A like belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
