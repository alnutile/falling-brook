<?php

namespace App;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportPostsRepository
{
    public function handle()
    {
        $files = File::allFiles(storage_path("app/posts"));

        /**
         * @TODO
         * Slug name from identifier or folder name
         * Tags plural ideally will happen
         */
        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() == "md") {
                try {
                    $content = File::get($file->getPathname());
                    $results = (new ProcessFile())->handle($content, $file);

                    if ($results->markdown) {
                        $post = Post::create($results->toModel());

                        foreach ($results->tags as $tag) {
                            $tag = trim($tag);
                            $post->tags()->firstOrCreate(
                                ['name' => Str::title($tag)],
                                ['slug' => Str::slug($tag)]
                            );
                        }
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
