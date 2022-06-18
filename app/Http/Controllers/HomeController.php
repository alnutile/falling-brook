<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Route;
use Facades\App\Screens\Welcome\GithubContributions;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {

        $search = $request->search;

        if ($search) {
            $recents = Post::search($search)->get();
            logger("This is search", [$search]);
        } else {
            $recents = Post::whereNotNull("body")->latest()->limit(3)->get();
        }


        /**
         * Get this from Cache
         */
        $contributions = GithubContributions::handle();

        return Inertia::render('Welcome', [
            'github_results' => $contributions,
            "tags" => Tag::topTags(),
            "search" => $search,
            'recents' => PostResource::collection($recents)
        ]);
    }
}
