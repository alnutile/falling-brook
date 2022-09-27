<?php

namespace App\Screens\Welcome;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class ContributionResponseDto extends DataTransferObject
{
    #[MapFrom('days')]
    public array $days;

    #[MapFrom('total')]
    public int $total;
}
