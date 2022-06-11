<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Facades\App\Screens\Welcome\GithubTransformData;

class GithubTransformDataTest extends TestCase
{

    public function test_transform_data()
    {
       $data = get_fixture("github_contributions.json");

       $results = GithubTransformData::handle($data);

       $first = $results->days[0];

       $this->assertNotEmpty($results);
       $this->assertCount(69, $results->days);
       $this->assertEquals("2022-04-04", $first['date']);
    }
}
