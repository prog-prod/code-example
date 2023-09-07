<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $sizes = [
            ["name" => "XS", "value" => "extra-small", "created_at" => $now, "updated_at" => $now],
            ["name" => "S", "value" => "small", "created_at" => $now, "updated_at" => $now],
            ["name" => "M", "value" => "medium", "created_at" => $now, "updated_at" => $now],
            ["name" => "L", "value" => "large", "created_at" => $now, "updated_at" => $now],
            ["name" => "XL", "value" => "extra-large", "created_at" => $now, "updated_at" => $now],
            ["name" => "XXL", "value" => "double-extra-large", "created_at" => $now, "updated_at" => $now],
            ["name" => "XXXL", "value" => "triple-extra-large", "created_at" => $now, "updated_at" => $now]
        ];
        Size::insert($sizes);
        $sizes = Size::all();

        Product::all()->each(function ($product) use ($sizes) {
            $size_array = $sizes->random(rand(1, 5))->pluck('id')->toArray();
            $count_sizes = count($size_array);
            foreach ($size_array as $id) {
                $product->sizes()->attach(
                    $id,
                    ['quantity' => fake()->numberBetween(1, $product->quantity / $count_sizes)]
                );
            }
        });
    }
}
