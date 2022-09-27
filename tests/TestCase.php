<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function turnFeatureOn($feature)
    {
        Artisan::call('feature:on', ['feature' => $feature]);
    }
}
