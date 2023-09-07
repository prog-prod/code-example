<?php

namespace App\Services;

use App\Contracts\WishlistRepositoryInterface;
use App\Contracts\WishlistServiceInterface;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WishlistService implements WishlistServiceInterface
{
    private ?User $user;
    private WishlistRepositoryInterface $wishlistRepository;
    private bool $checkAuth;

    /**
     * Create a new WishlistService instance.
     *
     */
    public function __construct()
    {
        $this->user = auth('web')->user();
        $this->wishlistRepository = app(WishlistRepositoryInterface::class);
        $this->checkAuth = auth('web')->check();
    }

    /**
     * Get the number of items in the wishlist.
     *
     * @return int The number of items in the wishlist.
     */
    public function getWishlistItemsCount(): int
    {
        if (!$this->checkAuth) {
            return collect((session("wishlist", [])))->flatten()->count();
        }
        return $this->user->wishlist->count();
    }

    /**
     * Check if a product is in the wishlist.
     *
     * @param Product $product The product to check.
     * @return bool True if the product is in the wishlist, false otherwise.
     */
    public function contains(Product $product): bool
    {
        if ($this->checkAuth) {
            return $this->user->wishlist->contains($product->id);
        }
        return session()->has("wishlist.{$product->id}");
    }

    /**
     * Get the wishlist items.
     *
     * @return LengthAwarePaginator|array The paginated list of wishlist items or an array of wishlist items.
     */
    public function getWishlist(): LengthAwarePaginator|array
    {
        if ($this->checkAuth) {
            return $this->user->wishlist()->paginate(9);
        }
        $products = array_keys(session("wishlist", []));
        return Product::query()->whereIn('id', $products)->globalWith()->paginate(9);
    }

    /**
     * Add a product to the wishlist.
     *
     * @param Product $product The product to add to the wishlist.
     * @return void
     */
    public function addToWishlist(Product $product): void
    {
        if ($this->checkAuth) {
            $this->wishlistRepository->addToWishlist($product);
        } else {
            session()->put("wishlist.{$product->id}", $product->id);
        }
    }

    /**
     * Delete a product from the wishlist.
     *
     * @param Product $product The product to delete from the wishlist.
     * @return void
     */
    public function deleteFromWishlist(Product $product): void
    {
        if ($this->checkAuth) {
            Wishlist::where('user_id', $this->user->id)
                ->where('product_id', $product->id)
                ->delete();
        } else {
            session()->remove("wishlist.$product->id");
        }
    }
}
