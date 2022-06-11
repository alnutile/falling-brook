<?php

namespace App\Screens\Welcome;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Facades\App\Screens\Welcome\GithubTransformData;

class GithubContributions
{
    public function handle(): ContributionResponseDto
    {
        $start = Carbon::now()->subDays(67)->startOfDay()->toIso8601String();
        $end = Carbon::now()->endOfDay()->toIso8601String();

        $results = Cache::remember($start, 86400, function () use ($start, $end) {
            $body = $this->getBody($start, $end);
            $body = [
                "query" => $body
            ];
            $token = config("blog.github_token");
            $response = Http::withHeaders([
                "Content-Type" => "application/json"
            ])->withToken($token)->post("https://api.github.com/graphql", $body);
            return $response->json();
        });

        return GithubTransformData::handle($results);
    }

    protected function getBody($start, $end): string
    {
        return <<<EOD
    query {
        user(login: "alnutile") {
          email
          createdAt
          contributionsCollection(from: "$start", to: "$end") {
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
    }
}
