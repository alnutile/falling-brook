<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "id" => $this->id,
            "html" => $this->html,
            "markdown" => $this->body,
            "date" => $this->created_at->format("Y-m-d"),
            "slug" => $this->slug,
            "read_time" => readtime($this->body),
            "hero" => random_hero(),
            "summary" => Str::of(Str::limit(strip_tags($this->body), 180))->markdown(),
        ]; 
    }
}
