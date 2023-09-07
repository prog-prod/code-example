<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, Product::max('id')),
            'cart_id' => $this->faker->numberBetween(1, Cart::max('id')),
            'color_id' => $this->faker->numberBetween(1, Color::max('id')),
            'size_id' => $this->faker->numberBetween(1, Size::max('id')),
            'product_name' => $this->faker->sentence(3),
            'product_price' => $this->faker->numberBetween(1000, 10000),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
