<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function turnFeatureOn($feature) {
        Artisan::call("feature:on", ["feature" => $feature]);
    }
}
