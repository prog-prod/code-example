<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SizeRepositoryInterface
{
    public function getSizeWithProductsCount(): Collection;
}
