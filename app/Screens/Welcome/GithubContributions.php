<?php

namespace App\Screens\Welcome;

use Carbon\Carbon;
use Facades\App\Screens\Welcome\GithubTransformData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use YlsIdeas\FeatureFlags\Facades\Features;

class GithubContributions
{
    public function handle(): ContributionResponseDto
    {
        $start = Carbon::now()->subDays(63)->startOfDay()->toIso8601String();
        $end = Carbon::now()->endOfDay()->toIso8601String();

        if (Features::accessible('save_dates')) {
            put_fixture('github_query_dates.json', ['start' => $start, 'end' => $end]);
        }

        $results = Cache::remember($start, 3600, function () use ($start, $end) {
            $body = $this->getBody($start, $end);
            $body = [
                'query' => $body,
            ];
            $token = config('blog.github_token');
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withToken($token)->post('https://api.github.com/graphql', $body);

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
