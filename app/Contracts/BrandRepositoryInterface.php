<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BrandRepositoryInterface
{

    public function getBrands(): Collection;
}
