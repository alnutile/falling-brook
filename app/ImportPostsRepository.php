<?php

namespace App;

use App\Models\Tag;
use App\Models\Post;
use App\Services\TagHelpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportPostsRepository
{
    use TagHelpers;

    public function handle()
    {
        $files = File::allFiles(storage_path("app/posts"));

        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() == "md") {
                try {
                    $content = File::get($file->getPathname());
                    $results = (new ProcessFile())->handle($content, $file);

                    if ($results->markdown) {
                        $post = Post::create($results->toModel());
                        $tags = $this->findOrCreateTags($results->tags);
                        $post->tags()->attach($tags);
                    }
                } catch (\Exception $e) {
                    logger($e->getMessage());
                }
            } elseif ($file->isFile() && ($file->getExtension() == "png" || $file->getExtension() == "jpg")) {
                $from = $file->getRealPath();
                $to = public_path("images/{$file->getFilename()}");
                File::copy($from, $to);
            }
        }
    }
}
