<?php

namespace App\Http\Controllers\Prints;

use App\Contracts\PrintCategoryRepositoryInterface;
use App\Contracts\ProductFilterInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Http\Controllers\BaseController;
use App\Http\Resources\PrintCategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\PrintCategory;

class PrintCategoryController extends BaseController
{
    public function show(
        PrintCategory $printCategory,
        PrintCategoryRepositoryInterface $printCategoryRepository,
        ProductRepositoryInterface $productRepository,
        ProductFilterInterface $filter
    ) {
        $categories = PrintCategoryResource::collection(
            $printCategoryRepository->getCategoryChildrenWithProductsCount($printCategory)
        );

        $products = ProductResource::collection($productRepository->getProductsByPrintCategory($printCategory));
        $filters = $filter->getFilters($printCategory);
        $category = new PrintCategoryResource($printCategory);

        return $this->showView(
            'Shop/Products',
            compact(['products', 'categories', 'category', 'filters'])
        );
    }
}
