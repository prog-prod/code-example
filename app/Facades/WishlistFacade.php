<?php

namespace App\Facades;

use App\Models\Product;
use Illuminate\Support\Facades\Facade;

/**
 * @method int getWishlistItemsCount()
 * @method bool contains(Product $product)
 *
 * @see \App\Services\WishlistService
 */
class WishlistFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'wishlist';
    }
}
