<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class TermsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_finds_content()
    {
        $post = Post::factory()->has(
            Tag::factory()->count(2)
        )->create();

        $tag = Tag::first();

        $this->get(route('terms.list', ['tag' => $tag->id]))->assertStatus(200);
    }

    public function test_inertia()
    {
        $post = Post::factory()->has(
            Tag::factory()->count(2)
        )->create();

        $tag = Tag::first();

        $this->get(route('terms.list', ['tag' => $tag->id]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Terms/List')
            ->has('posts'));
    }
}
