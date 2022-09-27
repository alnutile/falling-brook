<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_status()
    {
        $post = Post::factory()->has(
            Tag::factory()->count(2)
        )->count(10)->create();
        $this->get(route('posts.index'))->assertStatus(200);
    }

    public function test_inertia()
    {
        $post = Post::factory()->has(
            Tag::factory()->count(2)
        )->create();

        $this->get(route('posts.index'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Posts/Index')
                ->has('posts'));
    }
}
