<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory(40)->create();
        $tags = $tags->pluck('id');
        foreach (Product::all() as $product) {
            $product->tags()->attach($tags->random(fake()->numberBetween(1, 3)));
        }
    }
}
