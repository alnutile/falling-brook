<?php

namespace App\Screens\Welcome;

use Carbon\Carbon;

class GithubTransformData
{
    public function handle(array $data): ContributionResponseDto
    {
            $totals = data_get($data, 'data.user.contributionsCollection.contributionCalendar.totalContributions', 0);

            $data = data_get($data, 'data.user.contributionsCollection.contributionCalendar.weeks', []);



            $daysList = [];

            $template = [
                "color" => "#FFF",
                "contributionCount" => 0,
                "date" => '[DATE]',
                "weekday" => '[WEEKDAY]'
            ];

            foreach ($data as $contriDays) {
                $firstDay = $contriDays['firstDay'];
                foreach ($contriDays['contributionDays'] as $day) {
                    $currentDay = 0;
                    $date = $day['date'];
                    while ($day['weekday'] > $currentDay && $currentDay <= 7) {
                        if ($currentDay == 1) {
                            $template['date'] = $firstDay;
                        } else {
                            $template['date'] = Carbon::parse($firstDay)
                                ->addDays($currentDay)
                                ->format("Y-m-d");
                        }
                        $template['weekday'] = $currentDay;
                        $daysList[] = $template;
                        $currentDay++;
                        $daysList[] = $day;
                    }
                }
            }



            return new ContributionResponseDto(
                [
                    'total' => $totals,
                    "days" => $daysList,
                ]
            );
    }
}
