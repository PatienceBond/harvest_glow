<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImpactMetric>
 */
class ImpactMetricFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'value' => fake()->numberBetween(100, 10000),
            'unit' => fake()->randomElement(['farmers', 'hectares', 'kg', 'liters', '%']),
            'description' => fake()->sentence(),
            'icon' => fake()->randomElement(['users', 'leaf', 'trending-up', 'heart', 'star']),
            'color' => fake()->randomElement(['#388E3C', '#FFD700', '#FFA000', '#2E7D32', '#4CAF50']),
            'is_featured' => fake()->boolean(30),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
