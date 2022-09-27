<?php

namespace App\Screens\Welcome;

use YlsIdeas\FeatureFlags\Facades\Features;

class GithubTransformData
{
    public function handle(array $data): ContributionResponseDto
    {
        $totals = data_get($data, 'data.user.contributionsCollection.contributionCalendar.totalContributions', 0);

        $data = data_get($data, 'data.user.contributionsCollection.contributionCalendar.weeks', []);

        $daysList = [];

        $template = [
            'color' => '#E9ECEF',
            'contributionCount' => 0,
            'date' => '[DATE]',
            'weekday' => '[WEEKDAY]',
        ];

        foreach ($data as $contriDays) {
            $firstDay = $contriDays['firstDay'];
            foreach ($contriDays['contributionDays'] as $day) {
                $currentDay = 0;
                $date = $day['date'];
                $daysList[] = $day;
            }
        }

        if (Features::accessible('save_contrib')) {
            put_fixture('github_contrib_temp_data.json', $daysList);
        }

        return new ContributionResponseDto(
            [
                'total' => $totals,
                'days' => $daysList,
            ]
        );
    }
}
