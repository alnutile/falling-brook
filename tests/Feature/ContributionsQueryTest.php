<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ContributionsQueryTest extends TestCase
{
    public function test_can_query_contributions() {

        $body = <<<EOD
    query {
        user(login: "alnutile") {
          email
          createdAt
          contributionsCollection(from: "2022-05-11T00:00:00Z", to: "2022-06-10T23:05:23Z") {
            contributionCalendar {
              colors
              totalContributions
              weeks {
                contributionDays {
                  color
                  contributionCount
                  date
                  weekday
                }
                firstDay
              }
            }
          }
        }
    }
EOD;

        $payload = json_encode($body);
        $token = config("blog.github_token");
        $response = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->withToken($token)->post("https://api.github.com/graphql", [
            "query" => $body
        ]);

        put_fixture("github_contributions.json", $response->json());
    }
}
