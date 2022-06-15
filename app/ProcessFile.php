<?php

namespace App;

use Facades\App\Services\GithubMarkdown;
use Carbon\Carbon;
use Illuminate\Support\Str;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Output\RenderedContent;
use League\CommonMark\Output\RenderedContentInterface;
use Symfony\Component\Finder\SplFileInfo;

class ProcessFile
{
    public $title = null;

    public SplFileInfo $file;
    public string $html;
    public string $date = "";
    public string $stug = "";
    public string $image_url = "/images/heros/hero-messy.png";
    public string $markdown = "";
    public array $tags = [];

    public MarkdownConverter $converter;

    public function handle(string $content, SplFileInfo $file) : ProcessFile
    {
        $this->converter = GithubMarkdown::converter()  ;

        $this->processHeader();

        $this->file = $file;

        $this->markdown = $content;

        $this->html = $this->convert->getContent();
        return $this;
    }

    public function toModel()
    {
        return [
            "title" => $this->title,
            'body' => $this->markdown,
            "html" => $this->html,
            'image_url' => $this->image_url,
            "created_at" => Carbon::parse($this->date),
            "slug" => $this->slug,
            'active' => 1,
        ];
    }

    protected function processHeader()
    {
        $frontMatter = $this->convert->getFrontMatter();
        $this->title = data_get($frontMatter, "title");
        $this->date = data_get($frontMatter, "date");
        $this->image_url = data_get($frontMatter, "hero", $this->image_url);
        $this->tags = data_get($frontMatter, "tags");
        $this->slug = data_get($frontMatter, "menu.sidebar.identifier", Str::slug($this->title));
    }
}
