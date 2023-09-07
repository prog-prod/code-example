<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CountryRepositoryInterface
{
    public function getAllCountries(): Collection;
}
