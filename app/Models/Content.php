<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory;
    protected $table = 'contents';
    protected $fillable = [
        'name',
        'sub_name',
        'description',
        'image',
        'video',
        'item_1',
        'description_1',
        'item_2',
        'description_2',
        'item_3',
        'description_3',
        'item_4',
        'description_4',
    ];
}
