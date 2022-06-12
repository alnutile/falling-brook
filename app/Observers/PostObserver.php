<?php

namespace App\Observers;

use App\Models\Post;
use Facades\App\Services\PostsFixImagePaths;
use Illuminate\Support\Str;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $this->convertToHtml($post);
    }

    protected function convertToHtml(Post $post)
    {
        $body = PostsFixImagePaths::fixMarkDown($post->body);
        $html = Str::of($body)->markdown();
        $post->body = $body;
        $post->html = $html;
        $post->saveQuietly();
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        $this->convertToHtml($post);
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
