<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory()
    {
        $post = Post::factory()->create();
        $this->assertNotNull($post->title);
        $this->assertNotNull($post->html);
    }
}
