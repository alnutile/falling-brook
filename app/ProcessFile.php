<?php 

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class ProcessFile {


    public $title = null;

    /**
     * @var SplFileInfo $file
     */
    public $file = null;
    public $date = null;
    public $image_url = "/images/heros/hero-messy.png";
    public $markdown = null;
    public $tags = [];
    
    public function handle(string $content, SplFileInfo $file) {
        $this->processHeader($content);

        $this->file = $file;
        
        $this->markdown = Str::afterLast($content, "---\n");

        return $this;
    }

    public function toModel() {
        return [
            "title" => $this->title,
            'body' => $this->markdown,
            "html" => Str::of($this->markdown)->markdown(),
            'image_url' => $this->image_url,
            "created_at" => Carbon::parse($this->date),
            "slug" => $this->file->getBasename('.md')
        ];
    }

    protected function processHeader($content) {
        $tempArray = explode("\n", $content);

        foreach($tempArray as $line) {
            if(Str::startsWith($line, "title") && $this->title == null) {
                $this->title = Str::remove("\"", Str::after($line, "title: "));
            }

            if(Str::startsWith($line, "date") && $this->date == null) {
                $this->date = Str::after($line, "date: ");
            }

            if(Str::startsWith($line, "hero") && $this->image_url == null) {
                $this->image_url = Str::after($line, "hero: ");
            }

            if(Str::startsWith($line, "tags") && empty($this->tags)) {
                $tags = Str::remove("tags:", $line);
                $tags = Str::remove(["[", "]"], trim($tags));
                $this->tags = explode(",", $tags);
            }
        }
    }
}