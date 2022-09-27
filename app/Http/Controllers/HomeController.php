<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use Facades\App\Screens\Welcome\GithubContributions;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $recents = Post::search($search)
                ->where('active', 1)->get();
        } else {
            $recents = Post::published()
                ->whereNotNull('body')->latest()->limit(3)->get();
        }

        /**
         * Get this from Cache
         */
        $contributions = GithubContributions::handle();

        return Inertia::render('Welcome', [
            'github_results' => $contributions,
            'tags' => Tag::topTags(),
            'search' => $search,
            'recents' => PostResource::collection($recents),
        ]);
    }
}
