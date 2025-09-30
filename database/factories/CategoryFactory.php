<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);
        return [
            'name' => $name,
            'slug' => \Str::slug($name),
            'description' => fake()->paragraph(),
            'color' => fake()->randomElement(['#388E3C', '#FFD700', '#FFA000', '#2E7D32', '#4CAF50']),
        ];
    }
}
