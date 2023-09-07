<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(50)
            ->has(ProductFeature::factory(2), 'features')
            ->has(
                ProductImage::factory(2)->state(
                    new Sequence(

                        [
                            'main' => 1
                        ],
                        [
                            'main' => 0
                        ]
                    )
                )
                ,
                'images'
            )->create();
    }
}
