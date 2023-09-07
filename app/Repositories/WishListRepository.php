<?php

namespace App\Repositories;

use App\Contracts\WishlistRepositoryInterface;
use App\Models\Product;
use App\Models\Wishlist;
use Auth;

class WishListRepository implements WishlistRepositoryInterface
{

    public function addToWishlist(Product $product)
    {
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);
    }
}
