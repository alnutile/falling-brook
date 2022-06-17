<?php

use App\Models\Post;
use Inertia\Inertia;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Database\Eloquent\Builder;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Controllers\HomeController::class)->name("home");

Route::get("/about", function(){
    return Inertia::render("About");
})->name("about");

Route::get("/posts/{post}", function(Post $post) {
    if($post->active == 0) {
        abort(404);
    }

    return Inertia::render("Posts/Show", [
        "post" => new PostResource($post)
    ]);
})->name("posts.show");

Route::get("/posts", function() {
    $posts = Post::published()->latest()->paginate(12);

    return Inertia::render("Posts/Index", [
        "posts" => PostResource::collection($posts)
    ]);
})->name("posts.index");

Route::get("/terms/{tag}", function(\App\Models\Tag $tag) {
    $posts = Post::whereHas('tags', function (Builder $query) use ($tag) {
        $query->where('tags.id', $tag->id);
    })->latest()->simplePaginate(12);

 return Inertia::render("Terms/List", [
     "posts" => PostResource::collection($posts),
     "tag" => $tag
 ]);
})->name("terms.list");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
