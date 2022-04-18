<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelpersTest extends TestCase
{

    public function test_hero() {
        $this->assertNotNull(random_hero());
    }

    public function test_readtime()
    {
        $content = File::get(base_path("tests/fixtures/breaks.md"));

        $this->assertEquals(1.0, readtime($content));
    }
}
