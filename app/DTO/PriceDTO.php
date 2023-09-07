<?php

namespace App\DTO;

class PriceDTO
{
    public int $amount;
    public string $symbol;

    public function __construct(int $amount, string $symbol)
    {
        $this->amount = $amount;
        $this->symbol = $symbol;
    }
}
