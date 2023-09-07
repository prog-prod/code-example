<?php

namespace App\Repositories;

use App\Contracts\SizeRepositoryInterface;
use App\Models\Size;
use Illuminate\Database\Eloquent\Collection;

class SizeRepository implements SizeRepositoryInterface
{

    public function getSizeWithProductsCount(): Collection
    {
        return Size::withCount('products')->get();
    }
}
