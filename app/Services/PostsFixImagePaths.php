<?php

namespace App\Services;

use App\Models\Post;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;

class PostsFixImagePaths
{
    public MarkdownConverter $commonMarkConverter;

    public function __construct() {
        $config = Post::$markdownConfig;
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FootnoteExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $this->commonMarkConverter = new MarkdownConverter($environment);
    }

    public function convert($markdown) : string {
        return $this->commonMarkConverter->convert($markdown);
    }

    public function fixMarkdown($markdown): string
    {
        return $this->fix($markdown);
    }

    protected function fix($markdown): string
    {
        $markdown = str($markdown)->replace('](images', '](/images');
        $markdown = str($markdown)->replace('"images', '"/images');
        return $markdown;
    }

    public function handle()
    {
        Post::get()->map(
            function ($item) {
                $markdown = $this->fix($item->body);
                $item->body = $markdown;
                $item->html = $this->convert($markdown);
                $item->save();
            }
        );
    }
}
