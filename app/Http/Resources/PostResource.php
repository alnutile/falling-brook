<?php

namespace App\Http\Resources;

use Facades\App\Services\GithubMarkdown;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
        $body = GithubMarkdown::convert($this->body);

        return [
            'title' => $this->title,
            'id' => $this->id,
            'html' => $this->html,
            'markdown' => $this->body,
            'date' => $this->created_at->format('Y-m-d'),
            'slug' => $this->slug,
            'read_time' => readtime($this->body),
            'hero' => random_hero(),
            'tags' => $this->tags,
            'lead' => optional($this->tags->first())->name,
            'summary' => Str::limit($body->getContent(), 180),
        ];
    }
}
