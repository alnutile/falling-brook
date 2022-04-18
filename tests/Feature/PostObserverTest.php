<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory() {
        $model = Post::factory()->create();
        $this->assertNotNull($model->html);
    }
}
