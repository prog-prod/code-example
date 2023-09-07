<?php

namespace App\Repositories;

use App\Contracts\SaleRepositoryInterface;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository implements SaleRepositoryInterface
{
    public function getSales(): Collection
    {
        return Sale::all();
    }
}
