<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

if (!function_exists("random_hero")) {
    function random_hero()
    {
        $options = [
            "/images/heros/default-hero.jpg",
            "/images/heros/hero-coding.png",
            "/images/heros/hero-office.png",
            "/images/heros/hero-space.png",
            "/images/heros/hero-time.png",
            "/images/heros/hero-messy.png",
        ];
        return $options[array_rand($options)];
    }
}


if (!function_exists("readtime")) {
    function readtime(string $content)
    {
        return ceil(Str::wordCount($content) / 200);
    }
}

if (!function_exists("put_fixture")) {
    function put_fixture($file_name, $content = [], $json = true)
    {
        if ($json) {
            $content = json_encode($content, 128);
        }
        File::put(
            base_path(sprintf("tests/fixtures/%s", $file_name)),
            $content
        );
        return true;
    }
}

if (!function_exists("get_fixture")) {
    function get_fixture($file_name)
    {
        $results = File::get(base_path(sprintf(
            "tests/fixtures/%s",
            $file_name
        )));
        return json_decode($results, true);
    }
}
