<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    public function test_hero()
    {
        $this->assertNotNull(random_hero());
    }

    public function test_readtime()
    {
        $content = File::get(base_path('tests/fixtures/breaks.md'));

        $this->assertEquals(1.0, readtime($content));
    }
}
