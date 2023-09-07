<?php

namespace App\Http\Controllers;

use App\Contracts\ComparisonsServiceInterface;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ComparisonController extends BaseController
{

    public function index(ComparisonsServiceInterface $comparisonsService)
    {
        $categories = CategoryResource::collection($comparisonsService->getCategories());
        return $this->showView('Comparisons/Categories', compact('categories'));
    }

    public function showCategory(Request $request, Category $category, ComparisonsServiceInterface $comparisonsService)
    {
        $comparisons = ProductResource::collection($comparisonsService->getComparisons($category));
        return $this->showView('Comparisons/Comparisons', compact('comparisons'));
    }

    public function add(Product $product, ComparisonsServiceInterface $comparisonsService)
    {
        $comparisonsService->addComparison($product);
        return redirect()->back();
    }

    public function delete(Product $product, ComparisonsServiceInterface $comparisonsService)
    {
        $comparisonsService->deleteComparison($product);
        return redirect()->back();
    }
}
