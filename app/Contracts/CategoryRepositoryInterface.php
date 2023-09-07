<?php

namespace App\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getHierarchyCategories(): Collection;

    public function getCategoriesWithProductsCount(): Collection;

    public function getCategoryChildrenWithProductsCount(Category $category): Collection;

    public function getProducts(Category $category);

    public function getAll();
}
