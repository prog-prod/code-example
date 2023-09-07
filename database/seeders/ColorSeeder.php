<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = Color::factory()->count(10)->create();
        Product::all()->each(function ($product) use ($colors) {
            $product->colors()->attach(
                $colors->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
