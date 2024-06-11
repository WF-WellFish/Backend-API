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
            'name' => $this->faker->name(),
            'type' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'food' => $this->faker->name(),
            'food_shop' => $this->faker->name(),
            'picture' => $this->faker->name(),
        ];
    }
}
