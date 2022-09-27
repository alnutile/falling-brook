<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home()
    {
        $post = Post::factory()->create();
        $tag = Tag::factory()->create();
        $post->tags()->attach([$tag->id]);
        $this->get('/')
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has('tags')
            ->has('tags', 1, fn (Assert $page) => $page
                ->where('posts_count', 1)
                ->etc()
            )
        );
    }
}
