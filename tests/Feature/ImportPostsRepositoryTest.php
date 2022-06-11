<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\App\ImportPostsRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportPostsRepositoryTest extends TestCase
{

    use RefreshDatabase;

    public function test_interates_over_files() {
        $this->markTestSkipped("Just testing something locally");
        $this->assertDatabaseCount("posts", 0);
        ImportPostsRepository::handle();
        $this->assertDatabaseCount("posts", 262);
    }
}
