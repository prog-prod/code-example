<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = Sale::factory(25)->create();
        $products = Product::inRandomOrder()->limit(25)->get()->toArray();

        foreach ($sales as $key => $sale) {
            $sale->products()->attach($products[$key]['id']);
        }
    }
}
