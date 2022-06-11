<?php

namespace Tests\Feature\Http\Controllers;

use App\Screens\Welcome\ContributionResponseDto;
use App\Screens\Welcome\GithubTransformData;
use Facades\App\Screens\Welcome\GithubContributions;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_example()
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
}
