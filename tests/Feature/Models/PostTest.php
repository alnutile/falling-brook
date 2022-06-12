<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory() {
        $model = Post::factory()->create();
        $this->assertNotNull($model->title);
        $this->assertNotNull($model->body);
        $this->assertNotNull($model->slug);
        $this->assertNotNull($model->html);
        $this->assertNotNull($model->read_time);
    }

    public function test_active() {
        $post = Post::factory()->create();
        $post2 = Post::factory()->nonActive()->create();

        $posts = Post::published()->get();
        $this->assertCount(1, $posts);
    }

    public function test_tags() {
        $post = Post::factory()->create();

        $tag = "Foo";

        $post->tags()->firstOrCreate(
            ['name' => $tag],
            ['slug' => Str::slug($tag)]
        );

        $tag = "Bar";

        $post->tags()->firstOrCreate(
            ['name' => $tag],
            ['slug' => Str::slug($tag)]
        );

        $this->assertCount(2, $post->tags);
    }
}
