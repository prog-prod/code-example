<?php

namespace App\Contracts;

use App\Models\Product;

interface WishlistServiceInterface
{
    public function getWishlistItemsCount(): int;

    public function getWishlist();

    public function addToWishlist(Product $product);

    public function deleteFromWishlist(Product $product);

    public function contains(Product $product): bool;
}
