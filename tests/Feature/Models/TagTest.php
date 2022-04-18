<?php

namespace Tests\Feature\Models;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

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
}
