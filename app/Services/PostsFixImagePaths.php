<?php

namespace App\Services;

use App\Models\Post;
use Facades\App\Services\GithubMarkdown;

class PostsFixImagePaths
{

    public function handle()
    {
        Post::get()->map(
            function ($item) {
                $markdown = $this->fix($item->body);
                $item->body = $markdown;
                $item->html = GithubMarkdown::convert($markdown)->getContent();
                $item->save();
            }
        );
    }

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


}
