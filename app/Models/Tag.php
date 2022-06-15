<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function topTags()
    {
        return Tag::withCount("posts")->limit(5)->orderBy("posts_count", "DESC")->get();
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
