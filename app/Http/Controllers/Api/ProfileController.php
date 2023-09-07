<?php

namespace App\Http\Controllers\Api;

use App\Contracts\CountryRepositoryInterface;
use App\Http\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function getCountries(CountryRepositoryInterface $countryRepository)
    {
        return $countryRepository->getAllCountries();
    }
}
