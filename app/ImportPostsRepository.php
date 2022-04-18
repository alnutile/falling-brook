<?php 

namespace App;

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportPostsRepository {


    public function handle() {
        $files = File::allFiles(storage_path("app/posts"));

        foreach($files as $file) {
            if($file->isFile() && $file->getExtension() == "md") {
                try {
                    
                    $content = File::get($file->getPathname());
                    $results = (new ProcessFile)->handle($content, $file);
                    Post::create($results->toModel());
                } catch(\Exception $e) {
                    logger($e->getMessage());
                }
            } elseif ($file->isFile() && ($file->getExtension() == "png" || $file->getExtension() == "jpg")) {
                $from = $file->getRealPath();
                $to = public_path("images/{$file->getFilename()}");

                logger("Images", [$from, $to]);

                File::copy($from, $to);
            } 
        }
    }
}