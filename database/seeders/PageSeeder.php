<?php

namespace Database\Seeders;

use App\Models\Layout;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layout = Layout::where('key', 'main')->first();
        $now = now();
        $pages = [
            [
                'layout_id' => $layout->id,
                'slug' => 'home',
                'sections' => json_encode([
                    'hero_slider' => [
                        'active' => 1,
                        'order' => 1
                    ],
                    'top_categories' => [
                        'active' => 1,
                        'order' => 2
                    ],
                    'sale' => [
                        'link' => '/products',
                        'active' => 1,
                        'order' => 3
                    ],
                    'best_collections' => [
                        'active' => 1,
                        'product_ids' => [],
                        'order' => 4
                    ],
                    'deal' => [
                        'active' => 1,
                        'product_id' => null,
                        'order' => 5
                    ],
                    'instagram' => [
                        'active' => 1,
                        'order' => 6
                    ],
                    'service' => [
                        'active' => 1,
                        'order' => 7
                    ],
                    'subscription' => [
                        'active' => 1,
                        'order' => 8
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layout_id' => $layout->id,
                'slug' => 'contact-us',
                'sections' => json_encode([
                    'google_maps' => [
                        'active' => 1,
                        'order' => 1
                    ],
                    'contact_form' => [
                        'active' => 1,
                        'order' => 2
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'layout_id' => $layout->id,
                'slug' => 'about-us',
                'sections' => json_encode([
                    'about' => [
                        'active' => 1,
                        'image' => '/images/product.jpg',
                        'order' => 1
                    ],
                    'sale' => [
                        'active' => 1,
                        'link' => '/products',
                        'order' => 2
                    ],
                    'team' => [
                        'active' => 1,
                        'order' => 3
                    ]
                ]),
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
        Page::insert($pages);
    }
}
