<?php

namespace App\Http\Controllers\Shop;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ProductFilterInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SizeResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        ProductFilterInterface $filter
    ) {
        $categories = CategoryResource::collection(
            $categoryRepository->getCategoriesWithProductsCount()
        );
        $products = ProductResource::collection($productRepository->getAllProducts());
        $filters = $filter->getFilters();
        return $this->showView(
            'Shop/Products',
            compact(['products', 'categories', 'filters'])
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Product $product, ProductRepositoryInterface $productRepository)
    {
        $product->load(
            ['reviews.user', 'color', 'size', 'images', 'sales', 'features', 'related.images']
        );
        $products_with_similar_print = $productRepository->getProductsWithSimilarPrint($product);
        visits($product)->seconds(30)->increment();
        return $this->showView('Shop/Product', [
            'product' => new ProductResource($product),
            'productColors' => ColorResource::collection($product->colors),
            'productSizes' => SizeResource::collection($product->sizes),
            'similarProducts' => ProductResource::collection($product->similarProducts),
            'productsWithSimilarPrint' => ProductResource::collection($products_with_similar_print),
            'visits' => visits($product)->count()
        ]);
    }

    public function addReview(CreateReviewRequest $request, Product $product)
    {
        $validated = $request->validated();

        $user = \Auth::user();
        $review = Review::create([...$validated, 'product_id' => $product->id, 'user_id' => $user->id]);
        return redirect()->back()->with('success', 'Review has been created');
    }

    public function getQuickViewData(Product $product)
    {
        $similarProducts = $product->similarProducts;
        $productColors = $product->colors;
        $productSizes = $product->sizes;

        return [
            'similarProducts' => ProductResource::collection($similarProducts),
            'productColors' => ColorResource::collection($productColors),
            'productSizes' => SizeResource::collection($productSizes)
        ];
    }

    public function leaveReviewAfterOrder(Order $order)
    {
        $order->load(['customer', 'orderItems', 'orderItems.product', 'orderItems.product.reviews']);
        return $this->showView('Shop/ProductReview', [
            'order' => new OrderResource($order),
        ]);
    }
}
