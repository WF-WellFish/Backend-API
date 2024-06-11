<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassificationHistory>
 */
class ClassificationHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fish_name' => $this->faker->name(),
            'fish_type' => $this->faker->name(),
            'fish_description' => $this->faker->sentence(),
            'fish_food' => $this->faker->name(),
            'fish_food_shop' => $this->faker->name(),
        ];
    }
}
