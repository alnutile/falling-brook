<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Resources\PostResource;

class HomeController extends Controller
{
    public function __invoke()
    {
        $recents = Post::whereNotNull("body")->latest()->limit(3)->get();
        $payload = get_fixture("github_contributions.json");

        return Inertia::render('Welcome', [
            'github_results' => $payload,
            'recents' => PostResource::collection($recents)
        ]);
    }
}
