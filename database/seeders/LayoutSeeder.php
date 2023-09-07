<?php

namespace Database\Seeders;

use App\Models\Layout;
use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Layout::create([
            'key' => 'main',
            'header' => json_encode(['logo' => '/images/logo.png']),
            'footer' => json_encode([
                'logo' => '/images/logo-alt-new.png',
                'address' => '20464 Вигин крива, офіс, Емардтон, СТ 12471-4107',
                'phones' => ['+5(305) 785-0437'],
                'emails' => ['info@example.com'],
                'links' => [
                    [
                        'key' => 'blog',
                        'link' => '/blog',
                    ],
                    [
                        'key' => 'about-us',
                        'link' => '/about-us'
                    ],
                    [
                        'key' => 'our-shop',
                        'link' => '/products'
                    ],
                    [
                        'key' => 'contact-us',
                        'link' => '/contact-us'
                    ]
                ],
                'social_links' => [
                    'facebook' => [
                        'link' => 'https://www.facebook.com/',
                        'icon' => 'ti-facebook'
                    ],
                    'twitter' => [
                        'link' => 'https://twitter.com/',
                        'icon' => 'ti-twitter-alt'
                    ],
                    'vimeo' => [
                        'link' => 'https://vimeo.com/',
                        'icon' => 'ti-vimeo-alt'
                    ]
                ],
            ])
        ]);
    }
}
