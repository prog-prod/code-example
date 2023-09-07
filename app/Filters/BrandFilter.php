<?php

namespace App\Filters;

use App\Contracts\BrandRepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;

class BrandFilter extends AbstractFilter
{
    public Collection|array $values;
    private BrandRepositoryInterface $repository;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->repository = app()->make(BrandRepositoryInterface::class);
        $this->values = $this->getValues();
    }


    public function getValues(): Collection
    {
        return $this->repository->getBrands();
    }
}
