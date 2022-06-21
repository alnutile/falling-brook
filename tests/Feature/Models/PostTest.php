<?php

namespace Tests\Feature\Models;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Services\TagHelpers;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use TagHelpers;

    public function test_factory() {
        $model = Post::factory()->create();
        $this->assertNotNull($model->title);
        $this->assertNotNull($model->body);
        $this->assertNotNull($model->slug);
        $this->assertEquals(
            str($model->title)->slug()->value(),
            $model->slug
        );
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

        $tags = [
            "Foo",
            "Bar"
        ];
        $tagIds = $this->findOrCreateTags($tags);

        $post->tags()->attach($tagIds);

        $this->assertCount(2, $post->refresh()->tags);

        $post2 = Post::factory()->create();

        $post2->tags()->attach($tagIds);
        $this->assertCount(2, $post2->refresh()->tags);
    }


}
