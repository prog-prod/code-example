<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::has('user')->get();

        foreach (Product::all() as $product) {
            for ($i = 0; $i < fake()->numberBetween(0, 25); $i++) {
                Review::factory()->create([
                    'product_id' => $product->id,
                    'user_id' => $customers->random()->user->id
                ]);
            }
        }
    }
}
