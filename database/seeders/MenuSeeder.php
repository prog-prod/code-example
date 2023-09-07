<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    private array $megaMenuItems = ['mega_menu'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::factory()->count(1)->create([
            "name" => "main"
        ])->first();

        $menuItems = $this->transformMenuItems($this->getMenuItems());
        foreach ($menuItems as $item) {
            if ($item['parent_id'] != null) {
                $parent = MenuItem::where('name', $item['parent_id'])->whereNull('link')->first();
                $item['parent_id'] = $parent->id ?? null;
            }
            MenuItem::create($item);
        }
    }

    function transformMenuItems($menuItems, $parent = null)
    {
        $result = [];

        foreach ($menuItems as $key => $value) {
            $name = is_array($value) ? $key : $value;
            $name = trim(str_replace([" ", "&", "-"], ["_", "and", "_"], strtolower($name)));
            $link = is_array($value) ? null : ('/' . trim(str_replace([" ", "&"], ["-", "and"], strtolower($value))));
            $parent_id = $parent;

            $result[] = [
                'name' => $name,
                'menu_id' => 1,
                'mega' => in_array($name, $this->megaMenuItems),
                'link' => $this->isHome($value) ? '/' : $link,
                'parent_id' => $parent_id
            ];

            if (is_array($value)) {
                $result = array_merge($result, $this->transformMenuItems($value, $name));
            }
        }

        return $result;
    }

    private function getMenuItems()
    {
//        [
//            [
//                'url' => '/home',
//                'route' => 'home',
//                'name' => 'Home',
//                'children' => []
//            ],
//            [
//                'url' => null,
//                'route' => null,
//                'name' => 'Home',
//                'children' => [
//                    'url' => '/shop',
//                    'route' => 'shop',
//                    'name' => 'Home',
//                    'children' => []
//                ]
//
//            ]
        return [
            "home",
            "shop" => [
                "Shop",
                "Shop List",
                "Product Single",
                "Cart",
                "Shipping Method",
                "Payment Method",
                "Review",
                "Confirmation",
                "Track Order"
            ],
            "pages" => [
                "About Us",
                "Contact Us",
                "Login",
                "Signup",
                "Forget Password",
                "Dashboard",
                "FAQ",
                "404 Page",
                "Coming Soon",
                "Blog",
                "Blog Single"
            ],
            "Mega Menu" => [
                "Men" => [
                    "Jackets & Coats",
                    "Jeans",
                    "Top & T-Shirts",
                    "Dresses",
                    "Men Shirts"
                ],
                "Women" => [
                    "Blouses & Shirts",
                    "Dresses",
                    "Top & T-Shirts",
                    "Jeans & Trousers",
                    "Jackets & Coats"
                ],
                "Shoes & Bags" => [
                    "Backpacks",
                    "Bum Bags",
                    "Accross Bags",
                    "Shoes",
                    "Heeled Shoes"
                ],
                "Accessories" => [
                    "Sunglasses",
                    "Watches",
                    "Gloves",
                    "Capes & Hats",
                    "Belts"
                ]
            ],
            "Contact Us"
        ];
    }

    private function isHome($value)
    {
        return $value === 'home';
    }
}
