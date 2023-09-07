<?php

namespace Database\Seeders;

use App\Facades\OrderServiceFacade;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all customers
        $customers = Customer::whereId(1)->get();

        // Generate 10 orders for each customer
        foreach ($customers as $customer) {
            for ($i = 0; $i < 10; $i++) {
                // Select random number of products
                $numProducts = rand(1, 5);

                // Calculate total price
                $totalPrice = 0;
                $products = Product::inRandomOrder()->limit($numProducts)->get();
                foreach ($products as $product) {
                    $totalPrice += $product->price->getMinorAmount()->toInt();
                }
            }

            // Create order
            $order = Order::factory()->create([
                'customer_id' => $customer->id,
                'order_number' => OrderServiceFacade::generateOrderNumber($customer),
                'total_price' => $totalPrice,
            ]);

            // Create order items
            foreach ($products as $product) {
                $quantityProducts = rand(1, 3);
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantityProducts,
                    'price' => $product->price->getMinorAmount()->toInt() * $quantityProducts,
                ]);
            }
        }
    }
}
