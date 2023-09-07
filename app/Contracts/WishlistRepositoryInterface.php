<?php

namespace App\Contracts;

use App\Models\Product;

interface WishlistRepositoryInterface
{

    public function addToWishlist(Product $product);
}
