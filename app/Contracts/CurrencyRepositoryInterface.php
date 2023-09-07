<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CurrencyRepositoryInterface
{
    public function getCurrencies(): Collection;
}
