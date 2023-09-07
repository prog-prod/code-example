<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductFeature;
use Illuminate\Database\Seeder;

class ProductFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::query()->pluck('id');

        foreach ($products as $product_id) {
            ProductFeature::factory(fake()->numberBetween(1, 5))->create([
                'product_id' => $product_id
            ]);
        }
    }
}
