<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SaleRepositoryInterface
{
    public function getSales(): Collection;
}
