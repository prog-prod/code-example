<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'stedman',
            'sol_s',
            'just_hoods',
            'jhk',
            'headwear',
            'fruit_of_the_loom',
            'co_fee',
            'b_and_c',
            'atlantis',
            'american_style'
        ];
        foreach ($brands as $brand) {
            $created = Brand::factory()->create([
                'key' => $brand
            ]);
            $created->addTranslations([
                'name_uk' => fake()->unique()->word,
                'name_en' => fake()->unique()->word,
                'description_uk' => fake()->text,
                'description_en' => fake()->text,
            ]);
        }
    }
}
