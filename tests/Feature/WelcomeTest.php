<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home()
    {
        $post = Post::factory()->create();
        $tag = Tag::factory()->create();
        $post->tags()->attach([$tag->id]);
        $this->get("/")
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has("tags")
            ->has("tags", 1, fn (Assert $page) => $page
                ->where('posts_count', 1)
                ->etc()
            )
        );
    }
}
