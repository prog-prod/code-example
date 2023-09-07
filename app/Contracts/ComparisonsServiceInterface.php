<?php

namespace App\Contracts;

use App\Models\Category;
use App\Models\Product;

interface ComparisonsServiceInterface
{
    public function getComparisonsItemsCount(): int;

    public function getComparisons(Category $category);

    public function addComparison(Product $product);

    public function deleteComparison(Product $product);

    public function getCategories();
}
