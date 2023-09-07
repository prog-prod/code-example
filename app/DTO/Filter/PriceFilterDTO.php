<?php

namespace App\DTO\Filter;

use App\DTO\PriceDTO;

class PriceFilterDTO
{
    public PriceDTO $minPrice;
    public PriceDTO $maxPrice;

    public function __construct(PriceDTO $minPrice, PriceDTO $maxPrice)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }
}
