<?php

namespace App\Http\Controllers\Wishlist;

use App\Contracts\WishlistServiceInterface;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class WishlistController extends BaseController
{
    public function index(WishlistServiceInterface $wishlistService)
    {
        $wishlist = ProductResource::collection($wishlistService->getWishlist());
        return $this->showView('Wishlist', compact('wishlist'));
    }

    public function add(Product $product, WishlistServiceInterface $wishlistService)
    {
        $wishlistService->addToWishlist($product);

        return redirect()->back();
    }

    public function delete(Product $product, WishlistServiceInterface $wishlistService)
    {
        $wishlistService->deleteFromWishlist($product);
        return redirect()->back();
    }
}
