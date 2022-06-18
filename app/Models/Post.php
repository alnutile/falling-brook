<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $appends = ['read_time'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body
        ];
    }


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
