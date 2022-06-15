<?php

namespace App;

use Facades\App\Services\GithubMarkdown;
use Carbon\Carbon;
use Illuminate\Support\Str;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Output\RenderedContent;
use League\CommonMark\Output\RenderedContentInterface;
use Symfony\Component\Finder\SplFileInfo;

class ProcessFile
{
    public $title = null;

    public SplFileInfo $file;
    public string $html;
    public string $date;
    public string $slug;
    public string $image_url = "/images/heros/hero-messy.png";
    public string $markdown;
    public array $tags = [];

    public RenderedContentWithFrontMatter|RenderedContentInterface $convert;

    public function handle(string $content, SplFileInfo $file): ProcessFile
    {
        $this->convert = GithubMarkdown::convert($content);

        $this->processHeader();

        $this->file = $file;

        $this->markdown = \str($content)->afterLast("---\n")->value();

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
            /** @phpstan-ignore-next-line */
            "created_at" => Carbon::parse((int)$this->date),
            "slug" => $this->slug,
            'active' => 1,
        ];
    }

    protected function processHeader()
    {
        /** @phpstan-ignore-next-line */
        $frontMatter = $this->convert->getFrontMatter();
        $this->title = data_get($frontMatter, "title");
        $this->date = data_get($frontMatter, "date", now());
        $this->image_url = data_get($frontMatter, "hero", $this->image_url);
        $this->tags = data_get($frontMatter, "tags", []);
        $this->slug = data_get($frontMatter, "menu.sidebar.identifier", Str::slug($this->title));
    }
}
