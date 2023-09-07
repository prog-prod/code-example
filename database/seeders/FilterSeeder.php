<?php

namespace Database\Seeders;

use App\Enums\FilterEnum;
use App\Models\Category;
use App\Models\Filter;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getFilters() as $filter) {
            Filter::factory()->create([
                'name' => strtolower($filter)
            ]);
        }
        $categories = Category::all();
        $filters = Filter::all();
        $categories->each(function ($category) use ($filters) {
            $category->filters()->attach($filters->random()->id);
        });
    }


    private function getFilters(): array
    {
        return FilterEnum::getKeys();
    }
}
