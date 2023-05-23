<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poster>
 */
class PosterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'start' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'finish' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'cost' => $this->faker->numberBetween(1, 10000),
            'image' => $this->faker->image,
            'title' => $this->faker->word,
            'address' => $this->faker->address,
            'link' => $this->faker->url,
            'description' => $this->faker->sentence,
            'free' => $this->faker->boolean
        ];
    }
}
