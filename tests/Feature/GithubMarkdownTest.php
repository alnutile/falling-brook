<?php

namespace Tests\Feature;

use Facades\App\Services\GithubMarkdown;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use Tests\TestCase;

class GithubMarkdownTest extends TestCase
{
    public function test_converter()
    {
        $markdown = <<<'EOD'
---
layout: post
title: I Love Markdown
date: 2013-01-14
hero: /images/heros/hero-messy.png
tags:
  - test
  - example
menu:
  sidebar:
    name: "DrupalCamp Western Mass"
    identifier: drupal-camp--western--mass
    weight: -1
---

# Hello World!
MD;
EOD;
        $results = GithubMarkdown::convert($markdown);

        $this->assertInstanceOf(RenderedContentWithFrontMatter::class, $results);
        $results = $results->getFrontMatter();

        $this->assertArrayHasKey('layout', $results);
        $this->assertArrayHasKey('title', $results);
        $this->assertArrayHasKey('tags', $results);
    }
}
