<?php

namespace App\Filters;

use App\Contracts\FilterRepositoryInterface;
use App\Contracts\FiltersRelationInterface;
use App\Enums\FilterEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;

class FiltersFactory
{
    private Collection $filters;
    private ?FiltersRelationInterface $category;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(?FiltersRelationInterface $category = null)
    {
        $this->category = $category;

        $repository = app()->make(FilterRepositoryInterface::class);
        $this->filters = $category ? $category->filters : $repository->getAll();
    }

    /**
     * @throws BindingResolutionException
     */
    public function getFilters(): array
    {
        $filters = [];
        foreach ($this->filters as $filter) {
            $filters[$filter->name] = $this->createFilter(
                $filter
            );
        }
        return $filters;
    }

    /**
     * @throws BindingResolutionException
     */
    private function createFilter(
        mixed $filter
    ): AccessoriesFilter|TagsFilter|PriceFilter|PrintsFilter|CompositionFilter|SizeFilter|SexFilter|ColorFilter|BrandFilter|FashionFilter|null {
        return match ($filter->id) {
            FilterEnum::BRAND->value => new BrandFilter(),
            FilterEnum::COLOR->value => new ColorFilter(),
            FilterEnum::SIZE->value => new SizeFilter($this->category),
            FilterEnum::PRICE->value => new PriceFilter($this->category),
            FilterEnum::SEX->value => new SexFilter(),
            FilterEnum::FASHION->value => new FashionFilter(),
            FilterEnum::COMPOSITION->value => new CompositionFilter(),
            FilterEnum::ACCESSORIES->value => new AccessoriesFilter(),
            FilterEnum::TAGS->value => new TagsFilter(),
            FilterEnum::PRINTS->value => new PrintsFilter(),
            default => null,
        };
    }
}
