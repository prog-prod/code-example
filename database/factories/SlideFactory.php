<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slider_id' => Slider::max('id'),
            'image_webp_mobile' => null,
            'image_jpg_mobile' => null,
            'image_webp_desktop' => null,
            'image_jpg_desktop' => null,
            'image_jpg' => $this->faker->image('public/storage/slides', 248, 321, null, false),
            'link_url' => $this->faker->url,
            'order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
