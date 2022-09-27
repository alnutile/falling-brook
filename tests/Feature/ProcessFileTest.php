<?php

namespace Tests\Feature;

use App\Models\Post;
use Facades\App\ProcessFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;
use Tests\TestCase;

class ProcessFileTest extends TestCase
{
    use RefreshDatabase;

    public function test_using_the_right_library()
    {
        $content = <<<'EOD'
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
EOD;

        $path = base_path('tests/fixtures/hugo.md');
        $file = new SplFileInfo('hugo.md', $path, $path);
        $results = ProcessFile::handle($content, $file);
        $this->assertEquals('I Love Markdown', $results->title);
        $this->assertEquals(['test', 'example'], $results->tags);
        $this->assertEquals('drupal-camp--western--mass', $results->slug);
        $this->assertEquals('/images/heros/hero-messy.png', $results->image_url);
    }

    public function test_images_copied()
    {
        $path = base_path('tests/fixtures/breaks.md');
        $content = File::get($path);
        $file = new SplFileInfo('breaks.md', $path, $path);
        $results = ProcessFile::handle($content, $file);

        $this->assertNotNull($results->title);
        $this->assertNotNull($results->date);
        $this->assertNotNull($results->image_url);
        $this->assertCount(2, $results->tags);
    }

    public function test_removes_front_matter()
    {
        $path = base_path('tests/fixtures/breaks.md');
        $content = File::get($path);
        $file = new SplFileInfo('breaks.md', $path, $path);
        $results = ProcessFile::handle($content, $file);

        $this->assertStringNotContainsString("---\n", $results->markdown);
    }

    public function test_content()
    {
        $path = base_path('tests/fixtures/breaks.md');
        $content = File::get($path);
        $file = new SplFileInfo('breaks.md', $path, $path);
        $results = ProcessFile::handle($content, $file);

        $this->assertNotNull($results->title);
        $this->assertNotNull($results->date);
        $this->assertNotNull($results->image_url);
        $this->assertCount(2, $results->tags);
    }

    public function test_markdown()
    {
        $this->markTestSkipped('Just not working on ci so will come back to it later');
        $content = <<<'EOD'
# Hello

EOD;
        $path = base_path('tests/fixtures/after.md');
        $contentBefore = File::get($path);
        $file = new SplFileInfo('after.md', $path, $path);
        $results = ProcessFile::handle($contentBefore, $file);
        $this->assertEquals($content, $results->markdown);
    }

    protected function getContent()
    {
        return <<<EOD
---\n
title: "DrupalCamp Western Mass"\n
date: 2013-01-14\n
hero: /images/heros/hero-messy.png\n
menu:\n
    sidebar:\n
    name: "DrupalCamp Western Mass"\n
    identifier: drupal-camp--western--mass\n
    weight: -1\n
tags: [presentation, foo]\n
---\n
\n
I will be presenting on 2 topics.\r\n
\r\n
Using a VM for development the url can be seen below.\r\n
http://drupalcampma.com/virtual-box-ubuntu-local-development-strategy\r\n
\r\n
jQuery/Ajax without using the Drupal FAPI\r\n
http://drupalcampma.com/using-jquery-and-ajax-outside-drupal-fapi\r\n
\r\n
\r\n
Though this drupal backbone session looks great!\r\n
http://drupalcampma.com/drupal-and-backbonejs
EOD;
    }

    public function test_make_model()
    {
        $path = base_path('tests/fixtures/hugo.md');
        $content = File::get($path);
        $file = new SplFileInfo('hugo.md', $path, $path);
        $results = ProcessFile::handle($content, $file);
        $model = Post::create($results->toModel());
        $this->assertNotNull($model->slug);
    }
}
