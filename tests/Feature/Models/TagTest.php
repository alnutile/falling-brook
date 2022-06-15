<?php

namespace Tests\Feature\Models;

use App\Models\Tag;
use App\Services\TagHelpers;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    use TagHelpers;

    public function test_factory() {
        $model = Tag::factory()->create();
        $this->assertNotNull($model->name);
        $this->assertNotNull($model->slug);
    }

    public function test_relation() {
        $tag = Tag::factory()->
        has(Post::factory()->count(3))
        ->create();

        $this->assertCount(3, $tag->posts);

    }

    public function test_tags_count() {
        $postNoTags = Post::factory()->create();
        $post = Post::factory()->create();

        $tags = [
            "Foo",
            "Bar",
        ];
        $tagIds = $this->findOrCreateTags($tags);
        $post->tags()->attach($tagIds);
        $post2 = Post::factory()->create();
        $tags = [
            "Foo",
            "Bar",
            "Baz"
        ];
        $tagIds = $this->findOrCreateTags($tags);
        $post2->tags()->attach($tagIds);

        $tags = Tag::topTags();

        foreach($tags as $tag) {
            $this->assertNotEmpty($tag->posts_count);
        }
    }
}
