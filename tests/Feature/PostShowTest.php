<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class PostShowTest extends TestCase
{

    use RefreshDatabase;

    public function test_show_abort() {
        $post = Post::factory()->nonActive()->create();

        $this->get(route("posts.show", $post->id))->assertStatus(404);
    }

    public function test_inertia() {
        $post = Post::factory()->create();
        $this->get(route("posts.show", $post->id))
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Posts/Show'));

    }
}
