<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $datetime = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'product_id' => function () {
                return Product::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'rating' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->sentence,
            'body' => $this->faker->text,
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }
}
