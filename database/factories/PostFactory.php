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
    public function definition(): array
    {
        $address = ['yangon','mandalay','pyin oo lwin','nay pyi taw','inn lay'];
        return [
            'title' => $this->faker->sentence(8),
            'description' => $this->faker->text(500),
            'price' => rand(1000,50000000),
            'address' => $address[array_rand($address)],
            'rating' =>rand(0,5)
        ];
    }
}
