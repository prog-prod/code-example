<?php

namespace App\Repositories;

use App\Contracts\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandRepository implements BrandRepositoryInterface
{
    private Brand $model;

    public function __construct(Brand $model)
    {
        $this->model = $model;
    }

    public function getBrands(): Collection
    {
        return $this->model->all();
    }
}
