<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed for registered users
        $cartsRegistered = User::all()->map(function ($user) {
            return Cart::factory()->for($user)->create();
        });
        $cartsRegistered->each(function ($cart) {
            $products = Product::with(['color', 'size'])->inRandomOrder()->limit(4)->get()->map(
                function ($product) use ($cart) {
                    return [
                        'product_id' => $product->id,
                        'cart_id' => $cart->id,
                        'color_id' => $product->color_id,
                        'size_id' => $product->size_id,
                        'product_name' => $product->name,
                        'product_price' => $product->minor_price,
                    ];
                }
            );
            $products->each(function ($product) use ($cart) {
                $cart->items()->save(
                    CartItem::factory()->create($product)
                );
            });
        });
    }
}
