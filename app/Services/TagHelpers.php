<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Str;

trait TagHelpers
{
    public function findOrCreateTags(array $tags): array
    {
        $tagIds = [];
        foreach ($tags as $tag) {
            $tag = Tag::firstOrCreate(
                ['name' => Str::title($tag)],
                ['slug' => Str::slug($tag)]
            );
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }
}
