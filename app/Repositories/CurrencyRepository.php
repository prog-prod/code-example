<?php

namespace App\Repositories;

use App\Contracts\CurrencyRepositoryInterface;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getCurrencies(): Collection
    {
        return Currency::with('country')->get();
    }
}
