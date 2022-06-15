<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Facades\App\Screens\Welcome\GithubContributions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Resources\PostResource;

class HomeController extends Controller
{
    public function __invoke()
    {
        $recents = Post::whereNotNull("body")->latest()->limit(3)->get();
        /**
         * Get this from Cache
         */
        $contributions = GithubContributions::handle();

        return Inertia::render('Welcome', [
            'github_results' => $contributions,
            "tags" => Tag::topTags(),
            'recents' => PostResource::collection($recents)
        ]);
    }
}
