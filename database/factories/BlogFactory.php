<?php

namespace Database\Factories;

use App\Enums\BlogStatus;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * @return array|mixed[]
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => fake()->sentence(10),
            'slug' => fake()->slug(),
            'content' => fake()->text(),
            'status' => $this->faker->randomElement(BlogStatus::cases()),
        ];
    }
}
