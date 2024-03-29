<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory()
    {
        $model = Post::factory()->create();
        $this->assertNotNull($model->html);
    }
}
