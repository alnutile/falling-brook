<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Facades\App\Screens\Welcome\GithubContributions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GithubContributionsTest extends TestCase
{
    public function test_can_query_contributions() {

        $knownDate = Carbon::create(2022, 6, 11, 12);          // create testing date
        Carbon::setTestNow($knownDate);
        $data = get_fixture("github_contributions.json");

        Http::fake(
            [
                'api.github.com/*' => Http::response($data, 200, []),
            ]
        );

        $results = GithubContributions::handle();

        $this->assertNotEmpty($results);

        Http::assertSent(function (Request $request) {
            $shouldBe = get_fixture("github_request.json");
            return $shouldBe == $request->data();
        });

        put_fixture("github_contributions_repo.json", $results);
    }
}
