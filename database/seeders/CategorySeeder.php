<?php

namespace Database\Seeders;

use App\Models\Category;
use File;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private $directoryPath = 'public/storage/images';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = $this->getCategoriesForProducts();
        if (!File::exists($this->directoryPath)) {
            File::makeDirectory($this->directoryPath, 0755, true, true);
        }
        foreach ($categories as $category) {
            $this->createCategory($category);
        }
    }


    /**
     * Create a category and its children recursively.
     *
     * @param array $data
     * @param Category|null $parent
     * @return void
     */
    private function createCategory(array $data, ?Category $parent = null): void
    {
        $category = Category::factory()->create([
            'name' => $data['name'],
            'img' => $data['img'] ?? fake()->image($this->directoryPath, 50, 50, null, false),
            'parent_id' => optional($parent)->id,
        ]);

        foreach ($data['children'] as $childData) {
            $this->createCategory($childData, $category);
        }
    }


    private function getCategoriesForProducts(): array
    {
        return [
            [
                'name' => 'accessories',
                'children' => [
                    [
                        'name' => 'cups',
                        'img' => 'https://maikoff.ua/images/tmp/accessories/chashki.webp',
                        'children' => []
                    ],
                    [
                        'name' => 'eco-bags',
                        'img' => 'https://maikoff.ua/images/tmp/accessories/ekosumki.webp',
                        'children' => []
                    ],
                    [
                        'name' => 'thermoses',
                        'img' => 'https://maikoff.ua/images/tmp/accessories/termosi.webp',
                        'children' => []
                    ],
                    [
                        'name' => 'masks',
                        'img' => 'https://maikoff.ua/images/tmp/accessories/maska.webp',
                        'children' => []
                    ],
                    [
                        'name' => 'hats',
                        'img' => 'https://maikoff.ua/images/tmp/accessories/shapki.webp',
                        'children' => []
                    ],
                    [
                        'name' => 'caps',
                        'img' => 'https://maikoff.ua/images/tmp/accessories/kepki.webp',
                        'children' => []
                    ]
                ],
            ],
            [
                'name' => 'cloth',
                'children' => [
                    [
                        'name' => 't_shirts',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/tshirts-440x440.jpg',
                        'children' => [],
                    ],
                    [
                        'name' => 'polo',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/polo-440x440.jpg',
                        'children' => [],
                    ],
                    [
                        'name' => 'hoodie',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/hoodies-440x440.jpg',
                        'children' => [],
                    ],
                    [
                        'name' => 'sweatshirts',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/sweetshot-440x440.jpg',
                        'children' => [],
                    ],
                    [
                        'name' => 'caps_and_hats',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/cap-440x440.jpg',
                        'children' => [],
                    ],
                ],
            ],
            [
                'name' => 'prints',
                'children' => [
                    [
                        'name' => 'cups_with_prints',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/print-cups-440x440.jpg',
                        'children' => []
                    ],
                    [
                        'name' => 't_shirts_with_prints',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/print-tshirt-440x440.jpg',
                        'children' => []
                    ],
                    [
                        'name' => 'caps_with_prints',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/print-caps-440x440.jpg',
                        'children' => []
                    ],
                    [
                        'name' => 'masks_with_prints',
                        'img' => 'https://futbolka.ua/image/cache/catalog/product/print/flex/maski/m001/maskalico-440x440.png',
                        'children' => []
                    ],
                    [
                        'name' => 'sweatshirts_with_prints',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/sweet-print-440x440.jpg',
                        'children' => []
                    ],
                    [
                        'name' => 'hoodie_with_prints',
                        'img' => 'https://futbolka.ua/image/cache/catalog/category-img/hudi-print-440x440.jpg',
                        'children' => []
                    ],
                    [
                        'name' => 'shoppers_with_prints',
                        'img' => 'https://futbolka.ua/image/cache/catalog/2023/osnovy/img_5585-440x440.jpg',
                        'children' => []
                    ],
                ],
            ]
        ];
    }
}
