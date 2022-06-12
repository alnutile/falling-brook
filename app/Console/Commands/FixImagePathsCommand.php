<?php

namespace App\Console\Commands;

use App\Models\Post;
use Facades\App\Services\PostsFixImagePaths;
use Illuminate\Console\Command;

class FixImagePathsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:fix_image_paths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        PostsFixImagePaths::handle();
        return 0;
    }
}
