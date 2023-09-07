<?php

namespace Database\Factories;

use App\Models\Layout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Layout>
 */
class LayoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->word,
            'header_logo' => "/images/logo.png",
            'footer_logo' => "/images/logo-alt-new.png",
            "phones" => "+5(305) 785-0437",
            "emails" => "info@example.com",
            "top_ads_status" => "1",
            "top_ads_bg_color" => "#FF4135",
            "top_ads_link" => "/products",
        ];
    }
}
