<?php

namespace App\Services;

use App\Contracts\FiltersRelationInterface;
use App\Contracts\ProductFilterInterface;
use App\Filters\FiltersFactory;
use Illuminate\Contracts\Container\BindingResolutionException;

class FilterService implements ProductFilterInterface
{
    /**
     * Get the filters for the specified category.
     *
     * @param FiltersRelationInterface|null $category
     *
     * @return array
     * @throws BindingResolutionException
     */
    public function getFilters(?FiltersRelationInterface $category = null): array
    {
        return (new FiltersFactory($category))->getFilters();
    }
}
