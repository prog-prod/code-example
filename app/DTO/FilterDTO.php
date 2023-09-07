<?php

namespace App\DTO;

use App\DTO\Filter\PriceFilterDTO;
use App\Models\Color;

class FilterDTO
{
    public PriceFilterDTO $prices;

    /**
     * @var Color[]
     */
    public array $sizes;

    public function __construct(array $sizes, PriceFilterDTO $prices)
    {
        $this->prices = $prices;
        $this->sizes = $sizes;
    }
}
