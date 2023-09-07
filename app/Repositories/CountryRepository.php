<?php

namespace App\Repositories;

use App\Contracts\CountryRepositoryInterface;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository implements CountryRepositoryInterface
{

    public function getAllCountries(): Collection
    {
        return Country::all();
    }
}
