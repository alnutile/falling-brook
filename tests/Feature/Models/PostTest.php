<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\Post;
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
}
