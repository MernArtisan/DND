<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $guarded =[];
    public function images()
    {
        return $this->hasMany(ArticleImages::class, 'article_id');
    }
}
