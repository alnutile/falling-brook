<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->title(),
            "body" => $this->faker->sentences(4, true),
            "html" => null,
            "active" => 1,
            "image_url" => "/images/heros/hero-messy.png",
            "slug" => $this->faker->slug()
        ];
    }
}
