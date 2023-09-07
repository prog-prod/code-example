<?php


namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function getHierarchyCategories(): Collection
    {
        return Category::get()->toTree();
    }

    public function getCategoriesWithProductsCount(): Collection
    {
        return Category::rootCategories()->withChildrenProductsCount()
            ->get();
    }

    public function getProducts(Category $category): LengthAwarePaginator
    {
        return $category->products()->globalWith()->filtered()->sorted()->globalPaginate();
    }

    public function getCategoryChildrenWithProductsCount(Category $category): Collection
    {
        if (!$category->parent) {
            return Category::whereId($category->id)->withChildrenProductsCount()
                ->get();
        }

        return Category::whereId($category->parent->id)->withChildrenProductsCount()
            ->get();
    }

    public function getAll()
    {
        return Category::all();
    }
}
