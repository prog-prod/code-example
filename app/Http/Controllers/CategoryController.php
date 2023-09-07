<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ProductFilterInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function show(
        Category $category,
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        ProductFilterInterface $filter
    ) {
        $categories = CategoryResource::collection($categoryRepository->getCategoriesWithProductsCount());

        $products = ProductResource::collection($productRepository->getProductsOfCategory($category));
        $filters = $filter->getFilters($category);
        $category = new CategoryResource($category);

        return $this->showView(
            'Shop/Products',
            compact(['products', 'categories', 'category', 'filters'])
        );
    }
}
