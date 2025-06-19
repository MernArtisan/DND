<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HighlightComment extends Model
{
    protected $table = 'highlight_comments';

    public function highlight()
    {
        return $this->belongsTo(Highlight::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
