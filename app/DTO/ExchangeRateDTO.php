<?php

namespace App\DTO;

class ExchangeRateDTO
{
    public string $base;
    public int $timestamp;
    public string $date;
    public array $rates;

    public function __construct(array $data)
    {
        $this->base = $data['base'];
        $this->timestamp = $data['timestamp'];
        $this->date = $data['date'];
        $this->rates = $data['rates'];
    }
}
