<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Facades\App\Screens\Welcome\GithubTransformData;
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
        $payload = get_fixture("github_contributions.json");
        $contributions = GithubContrbutions::handle();

        return Inertia::render('Welcome', [
            'github_results' => GithubTransformData::handle($payload),
            'recents' => PostResource::collection($recents)
        ]);
    }
}
