<?php

namespace App\Services;

use App\Contracts\ProductServiceInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class ProductService implements ProductServiceInterface
{

    public function getTotalWeight(Collection $products = null, Order|null $order = null): float
    {
        if ($order && !$products) {
            $order->load(['orderItems', 'orderItems.product']);
            $products = $order->orderItems->map(function ($orderItem) {
                return $orderItem->product;
            });
        }
        if ($products) {
            $weight = $products->reduce(function ($carry, $product) {
                return $carry + ($product->weight / 1000); // g to kg
            }, 0);
        } else {
            $weight = 0;
        }


        return $weight === 0 ? 0.01 : $weight;
    }
}
