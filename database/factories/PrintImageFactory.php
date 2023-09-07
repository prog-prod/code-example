<?php

namespace Database\Factories;

use App\Models\PrintCategory;
use App\Models\PrintImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PrintImage>
 */
class PrintImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->word(),
            'print_category_id' => $this->faker->numberBetween(1, PrintCategory::max('id')),
            'image' => $this->faker->image('public/storage/images', 100, 100, null, false),
        ];
    }
}
