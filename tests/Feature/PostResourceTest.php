<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Database\Factories\PostFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory() {
        $post = Post::factory()->create();
        $this->assertNotNull($post->title);
        $this->assertNotNull($post->html);
    }
}
