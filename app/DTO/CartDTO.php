<?php

namespace App\DTO;

class CartDTO
{
    public array $items = [];
    public array $taxes = [];
    public int $count = 0;

    public function __construct(array $items, array $taxes = [], int $count = 0)
    {
        $this->items = $items;
        $this->taxes = $taxes;
        $this->count = $count;
    }
}
