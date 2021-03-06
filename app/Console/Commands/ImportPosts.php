<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Facades\App\ImportPostsRepository;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alfrednutile:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Blog Posts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ImportPostsRepository::handle();

        return 0;
    }
}
