<?php

namespace App\Repositories;

use App\Contracts\FilterRepositoryInterface;
use App\Models\Filter;
use Illuminate\Database\Eloquent\Collection;

class FilterRepository implements FilterRepositoryInterface
{
    public function getAll(): Collection
    {
        return Filter::all();
    }

    public function getPriceFilter()
    {
        return Filter::whereKey('price')->first();
    }
}
