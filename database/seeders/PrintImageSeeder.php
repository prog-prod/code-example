<?php

namespace Database\Seeders;

use App\Enums\PrintPositionEnum;
use App\Enums\PrintSizeEnum;
use App\Models\PrintImage;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PrintImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prints = PrintImage::factory(30)->create();
        PrintImage::factory(30);
        foreach (Product::inRandomOrder()->limit(30)->get() as $product) {
            $product->prints()->attach(
                $prints->random()->id,
                [
                    'position' => collect(PrintPositionEnum::getValues())->random(),
                    'size' => collect(PrintSizeEnum::getValues())->random(),
                ]
            );
        }
    }
}
