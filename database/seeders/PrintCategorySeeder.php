<?php

namespace Database\Seeders;

use App\Models\PrintCategory;
use Illuminate\Database\Seeder;

class PrintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prints_categories = $this->getCategoriesForPrints();

        foreach ($prints_categories as $prints_category) {
            PrintCategory::factory()->create([
                'name' => $prints_category
            ]);
        }
    }

    private function getCategoriesForPrints(): array
    {
        return [
            'superheroes_comics',
            'funny',
            'series',
            'ukrainian_symbols',
            'eco',
            'sale',
            'swag',
            'automotive',
            'anime',
            'alcohol',
            'biker',
            'pregnant',
            'love',
            'gamers',
            'cities',
            'maiden',
            'animals',
            'names',
            'anniversary',
            'images',
            'motion_pictures',
            'bachelor_party',
            'family',
            'holiday',
            'famous_brands',
            'professions',
            'couples',
            'zodiac_signs',
            'newlyweds',
            'athletes',
            'indecent',
            'inscriptions',
            'fishing_and_hunting',
            'tailcoats_and_ties',
            'surname_and_number',
        ];
    }
}
