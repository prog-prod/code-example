<?php

namespace Database\Factories;

use App\Models\Layout;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique->word,
            'layout_id' => $this->faker->numberBetween(1, Layout::max('id'))
        ];
    }
}
