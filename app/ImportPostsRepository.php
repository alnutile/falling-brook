<?php 

namespace App;

use App\Models\Post;
use Illuminate\Support\Facades\File;

class ImportPostsRepository {


    public function handle() {
        $files = File::allFiles(storage_path("app/posts"));

        foreach($files as $file) {
            if($file->isFile() && $file->getExtension() == "md") {
                try {
                    logger("Files", [$file->getPathname()]);
                    $content = File::get($file->getPathname());
                    $results = (new ProcessFile)->handle($content, $file);
                    Post::create($results->toModel());
                } catch(\Exception $e) {
                    logger($e->getMessage());
                }
            }
        }
    }
}