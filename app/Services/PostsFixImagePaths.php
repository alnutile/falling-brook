<?php

namespace App\Services;

use App\Models\Post;

class PostsFixImagePaths
{
    public function fixMarkdown($markdown): string
    {
        return $this->fix($markdown);
    }

    protected function fix($markdown): string
    {
        $markdown = str($markdown)->replace('](images', '](/images');
        $markdown = str($markdown)->replace('"images', '"/images');
        return $markdown;
    }

    public function handle()
    {
        Post::get()->map(
            function ($item) {
                $markdown = $this->fix($item->body);
                $item->body = $markdown;
                $item->save();
            }
        );
    }
}
