<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $percent = $this->faker->numberBetween(1, 100);
        return [
            'key' => $this->faker->unique()->word,
            'quantity' => $quantity,
            'percent' => $percent,
            'endDate' => $this->faker->dateTimeBetween('today', '+1 month')->format('Y-m-d H:i:s')
        ];
    }
}
