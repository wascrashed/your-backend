<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

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
            'language' => $this->faker->word,
            'publication_type' => $this->faker->word,
            'image' => $this->faker->image,
            'title' => $this->faker->name,
            'description' => $this->faker->sentence,
            'heading' => $this->faker->sentence,
            'tags' => $this->faker->sentence,
            'site_location' => $this->faker->numberBetween(1, 20),
            'link' => $this->faker->url,
            'content' => $this->faker->text,
            'author_comment' => $this->faker->sentence,
            'user_id' => $this->faker->numberBetween(1, 40)
        ];
    }
}
