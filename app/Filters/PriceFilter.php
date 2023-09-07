<?php

namespace App\Filters;

use App\Contracts\ProductRepositoryInterface;
use App\DTO\Filter\PriceFilterDTO;
use App\Facades\CurrencyFacade;
use App\Models\Category;
use Illuminate\Contracts\Container\BindingResolutionException;

class PriceFilter extends AbstractFilter
{
    public PriceFilterDTO $values;
    private Category|null $category;
    private ProductRepositoryInterface $productRepository;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(Category|null $category = null)
    {
        $this->category = $category;
        $this->productRepository = app()->make(ProductRepositoryInterface::class);
        $this->values = $this->getValues();
    }


    public function getValues(): PriceFilterDTO
    {
        $category = $this->category;
        $repository = $this->productRepository;

        $prices = !$category
            ? $repository->getMinMaxPrices()
            : $repository->getMinMaxPrices($category);
        $from = request('filters.price.from')
            ? CurrencyFacade::getPriceObject(
                request('filters.price.from')
            )
            : null;
        $to = request('filters.price.to')
            ? CurrencyFacade::getPriceObject(
                request('filters.price.to')
            )
            : null;

        if (!$from) {
            $from = $prices->min_price ? CurrencyFacade::getPriceObject(
                $prices->min_price
            ) : CurrencyFacade::getMinPriceLimitForFilter();
            $to = $prices->max_price ? CurrencyFacade::getPriceObject(
                $prices->max_price
            ) : CurrencyFacade::getMaxPriceLimitForFilter();
        }
        
        return new PriceFilterDTO(
            minPrice: $from,
            maxPrice: $to
        );
    }
}
