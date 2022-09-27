<?php

namespace Tests\Feature;

use Facades\App\Screens\Welcome\GithubTransformData;
use Tests\TestCase;

class GithubTransformDataTest extends TestCase
{
    public function test_transform_data()
    {
        $data = get_fixture('github_contributions.json');

        $results = GithubTransformData::handle($data);

        $first = $results->days[0];

        $this->assertNotEmpty($results);
        $this->assertCount(69, $results->days);
        $this->assertEquals('2022-04-04', $first['date']);
    }
}
