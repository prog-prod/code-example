<?php

namespace App\Repositories;

use App\Contracts\PrintCategoryRepositoryInterface;
use App\Models\PrintCategory;
use Illuminate\Database\Eloquent\Collection;

class PrintCategoryRepository implements PrintCategoryRepositoryInterface
{

    public function getAll(): Collection
    {
        return PrintCategory::all();
    }

    public function getHierarchyCategories(): Collection
    {
        return PrintCategory::get()->toTree();
    }

    public function getCategoryChildrenWithProductsCount(PrintCategory $printCategory)
    {
        return PrintCategory::withChildrenProductsCount()->get()->toTree();
    }
}
