<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $table = 'streams';
    protected $guarded = [];
    protected $fillable = [
        'stream_id',
        'team_1',
        'team_2',
        'category_id',
        'channel_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'location',
        'image',
        'description',
        'status',
        'location_symbol',
        'team2_symbol',
        'team1_symbol',
        'score_card'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
