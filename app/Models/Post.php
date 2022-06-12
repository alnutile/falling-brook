<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['read_time'];

    public function getReadTimeAttribute()
    {
        return readtime($this->body);
    }

    public function scopePublished(Builder $query)
    {
        return $query->where("active", 1);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
