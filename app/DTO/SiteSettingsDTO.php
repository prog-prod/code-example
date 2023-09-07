<?php

namespace App\DTO;

use App\DTO\Filter\PriceFilterDTO;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingsDTO
{
    public array $locales = [];
    public string $locale;
    public string $currency;
    public array $social_networks;
    public array $currencies = [];
    public \stdClass $sortBy;
    public PriceFilterDTO $filter;
    public int $countItemsInCart;
    public int $countItemsWishlist;
    public int $countItemsComparisons;
    public JsonResource $layout;

    public function __construct(
        array $locales,
        string $locale,
        array $currencies,
        string $currency,
        array $social_networks,
        \stdClass $sortBy,
        PriceFilterDTO $filter,
        int $countItemsInCart,
        int $countItemsWishlist,
        int $countItemsComparisons,
        JsonResource $layout
    ) {
        $this->locales = $locales;
        $this->locale = $locale;
        $this->currency = $currency;
        $this->currencies = $currencies;
        $this->social_networks = $social_networks;
        $this->sortBy = $sortBy;
        $this->filter = $filter;
        $this->countItemsInCart = $countItemsInCart;
        $this->countItemsWishlist = $countItemsWishlist;
        $this->countItemsComparisons = $countItemsComparisons;
        $this->layout = $layout;
    }
}
