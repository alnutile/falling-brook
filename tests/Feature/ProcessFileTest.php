<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Facades\App\ProcessFile;
use Illuminate\Support\Facades\File;
use Facades\App\ImportPostsRepository;
use Symfony\Component\Process\Process;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcessFileTest extends TestCase
{

    use RefreshDatabase;
    
    public function test_broken_title() {
        $path = base_path("tests/fixtures/breaks.md");
        $content = File::get($path);
        $file = new SplFileInfo("breaks.md", $path, $path);
        $results = ProcessFile::handle($content, $file);

        $this->assertNotNull($results->title);
        $this->assertNotNull($results->date);
        $this->assertNotNull($results->image_url);
        $this->assertCount(2, $results->tags);
        Post::create($results->toModel());
    }

    public function test_images_copied() {
        $path = base_path("tests/fixtures/breaks.md");
        $content = File::get($path);
        $file = new SplFileInfo("breaks.md", $path, $path);
        $results = ProcessFile::handle($content, $file);

        $this->assertNotNull($results->title);
        $this->assertNotNull($results->date);
        $this->assertNotNull($results->image_url);
        $this->assertCount(2, $results->tags);
    }

    public function test_content() {
        $content = $this->getContent();
        $results = ProcessFile::handle($content);

        $this->assertNotNull($results->title);
        $this->assertNotNull($results->date);
        $this->assertNotNull($results->image_url);
        $this->assertCount(2, $results->tags);
    }

    public function test_markdown() {
        $content = <<<EOD
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
        $content = $this->getContent();
        $results = ProcessFile::handle($content);
        $this->assertEquals($results->markdown, $content);
    }

    protected function getContent() {
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

    public function test_make_model() {
        $content = $this->getContent();
        $results = ProcessFile::handle($content);

        $model = Post::create($results->toModel());

        $this->assertNotNull($model->slug);
    }

    public function test_for_reals() {
        ImportPostsRepository::handle();
    }
}
