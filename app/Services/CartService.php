<?php

namespace App\Services;

use App\Contracts\CartRepositoryInterface;
use App\Contracts\CartServiceInterface;
use App\DTO\CartDTO;
use App\Exceptions\ProductQuantityException;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Brick\Math\Exception\MathException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartService implements CartServiceInterface
{
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        if (auth('web')->check() && !auth('web')->user()->cart) {
            $cartRepository->createCart(auth()->user());
        }
    }

    /**
     * Get the cart items.
     *
     * @return CartDTO
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getItems(): CartDTO
    {
        // \Session::flush();
        if (auth()->user() && auth()->user()->cart) {
            auth()->user()->cart->load(['items', 'items.product.images', 'items.product.sales']);
            return new CartDTO(
                items: auth()->user()->cart->items->map(fn($item) => new CartItemResource($item))->toArray()
            );
        } else {
            if (session()->has('cartItems')) {
                return new CartDTO(
                    items: collect(session()->get('cartItems'))->sortBy('id')->values()->toArray()
                );
            } else {
                return new CartDTO(items: []);
            }
        }
    }

    /**
     * Get the count of items in the cart.
     *
     * @return int
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function countItems(): int
    {
        if (auth()->user() && auth()->user()->cart) {
            return auth()->user()->cart->items->count();
        } else {
            if (session()->has('cartItems')) {
                return count(session()->get('cartItems'));
            } else {
                return 0;
            }
        }
    }

    /**
     * Add an item to the cart.
     *
     * @param Product $product
     * @param int $quantity
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ProductQuantityException|MathException
     */
    public function addItem(Product $product, int $quantity = 1): void
    {
        if ($quantity > $product->quantity) {
            throw new ProductQuantityException();
        }

        if (auth()->check()) {
            $cart = auth()->user()->cart;
            $existingItem = $cart->items()->where('product_id', $product->id)->first();

            if ($existingItem) {
                $newQuantity = $existingItem->quantity + $quantity;
                if ($newQuantity > $product->quantity) {
                    throw new ProductQuantityException();
                }
                $existingItem->update([
                    'quantity' => $newQuantity
                ]);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'product_price' => $this->calcProductPrice($product, $quantity),
                    'product_name' => $product->name,
                ]);
            }
        } else {
            $items = session()->get('cartItems', []);

            if (isset($items[$product->id])) {
                $newQuantity = $items[$product->id]['quantity'] + $quantity;

                if ($newQuantity > $product->quantity) {
                    throw new ProductQuantityException();
                }

                $items[$product->id]['quantity'] = $newQuantity;
            } else {
                if (($quantity + 1) > $product->quantity) {
                    throw new ProductQuantityException();
                }
                $items[$product->id] = [
                    'id' => count($items) + 1,
                    'product' => (new ProductResource($product))->jsonSerialize(),
                    'quantity' => $quantity,
                ];
            }
            session()->put('cartItems', $items);
        }
    }

    /**
     * Delete an item from the cart.
     *
     * @param Product $product
     * @return void
     */
    public function deleteItem(Product $product): void
    {
        if (auth()->user()) {
            auth()->user()->cart->items()->whereBelongsTo($product)->delete();
        } else {
            if (session()->has("cartItems")) {
                session()->remove("cartItems.{$product->id}");
            }
        }
    }

    /**
     * Calculate the price of a product.
     *
     * @param Product $product
     * @param int $quantity
     * @return int
     * @throws MathException
     */
    public function calcProductPrice(Product $product, int $quantity = 1): int
    {
        if (is_null($product->priceWithDiscount)) {
            return $product->minorPrice * $quantity;
        }
        if ($quantity <= $product->sale->quantity) {
            return $product->priceWithDiscount->getMinorAmount()->toInt() * $quantity;
        }
        return $product->priceWithDiscount->getMinorAmount()->toInt() * $product->sale->quantity +
            $product->minorPrice * ($quantity - $product->sale->quantity);
    }

    public function clearCart(): void
    {
        if (auth()->user() && auth()->user()->cart) {
            auth()->user()->cart->items()->delete();
        } else {
            session()->forget('cartItems');
        }
    }
}
