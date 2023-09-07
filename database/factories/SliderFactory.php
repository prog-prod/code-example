<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'autoplay_speed' => $this->faker->numberBetween(1000, 5000),
            'autoplay' => true,
            'lazyLoad' => 'progressive',
            'infinite' => true,
            'pause_on_focus' => false,
            'pause_on_hover' => false,
            'arrows' => true,
            'dots' => false,
            'speed' => $this->faker->numberBetween(500, 2000),
        ];
    }
}
