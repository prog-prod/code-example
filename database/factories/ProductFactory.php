<?php

namespace Database\Factories;

use App\Enums\CurrencyEnum;
use App\Enums\GenderEnum;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => $this->faker->numberBetween(1, Category::max('id')),
            'brand_id' => $this->faker->numberBetween(1, Brand::max('id')),
            'key' => $this->faker->unique()->word(),
            'slug' => $this->faker->unique()->word(),
            'currency_name' => CurrencyEnum::UAH->value,
            'gender_id' => collect(GenderEnum::getValues())->random(),
            'price' => $this->faker->numberBetween(100, 100000),
            'stock_quantity' => $this->faker->numberBetween(0, 500),
        ];
    }
}
