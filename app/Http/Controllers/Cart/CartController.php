<?php

namespace App\Http\Controllers\Cart;

use App\Contracts\CartServiceInterface;
use App\Exceptions\ProductQuantityException;
use App\Http\Controllers\BaseController;
use App\Http\Requests\AddItemToCartRequest;
use App\Models\Product;

class CartController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartServiceInterface $cartService)
    {
        $cart = $cartService->getItems();
        $taxes = [];
        return $this->showView('Cart/Cart', compact('cart', 'taxes'));
    }

    public function delete(
        Product $product,
        CartServiceInterface $cartService
    ) {
        $cartService->deleteItem($product);
        return back();
    }

    public function add(
        AddItemToCartRequest $request,
        Product $product,
        CartServiceInterface $cartService
    ) {
        try {
            $product->load(['sales', 'images']);
            $cartService->addItem(
                $product,
                $request->get('quantity', 1)
            );
            return back();
        } catch (ProductQuantityException $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
