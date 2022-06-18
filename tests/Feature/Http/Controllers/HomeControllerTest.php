<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use App\Screens\Welcome\GithubTransformData;
use App\Screens\Welcome\ContributionResponseDto;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\App\Screens\Welcome\GithubContributions;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_git()
    {
        $data = new ContributionResponseDto(
            [
                "days" => [],
                "total" => 444
            ]
        );
        GithubContributions::shouldReceive('handle')->andReturn($data);
        
        
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_search() {
        $this->turnFeatureOn("search");
        
        $post2 = Post::factory()->create(
            ['title' => "Baz"]
        );
        
        $post = Post::factory()->create(
            ['title' => "Foobar"]
        );
        $data = new ContributionResponseDto(
            [
                "days" => [],
                "total" => 444
            ]
        );
        GithubContributions::shouldReceive('handle')->andReturn($data);
        
        $this->get("/")
            ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has("recents.data", 2)
        );

        $this->get("/?search=Foobar")
            ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has("recents.data", 1)
        );
    }
}
