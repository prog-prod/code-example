<?php

namespace App\Contracts;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductServiceInterface
{
    /**
     * @param Collection{Product} $products
     * @return mixed
     */
    public function getTotalWeight(Collection $products, ?Order $order = null): float;
}
