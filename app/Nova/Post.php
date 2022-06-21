<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Markdown;
use Illuminate\Filesystem\Filesystem;
use Laravel\Nova\Fields\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        "title",
        "body"
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        // $path = public_path("images/heros/");
        // $heros = Storage::disk("local")->files($path);

        // logger($heros);
        return [
            ID::make()->sortable(),
            Text::make("title"),
            Markdown::make("body"),
            BelongsToMany::make("Tags"),
            Boolean::make("Acitve")->default(1),
            Text::make("slug")->placeholder('This will come from title you can edit on updstate')->readonly(function ($request) {
                return $request->isCreateOrAttachRequest();
            }),
            Select::make('Image Url')->options([
                '/images/heros/default-hero.jpg' => '/images/heros/default-hero.jpg',
                "/images/heros/hero-coding.jpg" => "/images/heros/hero-coding.jpg",
                "/images/heros/hero-messy.jpg" => "/images/heros/hero-messy.jpg",
                "/images/heros/hero-office.jpg" => "/images/heros/hero-office.jpg",
                "/images/heros/hero-space.jpg" => "/images/heros/hero-space.jpg",
                "/images/heros/hero-time.jpg" => "/images/heros/hero-time.jpg",
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
