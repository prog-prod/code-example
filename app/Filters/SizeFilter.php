<?php

namespace App\Filters;

use App\Contracts\SizeRepositoryInterface;
use App\Http\Resources\SizeResource;
use App\Models\Category;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SizeFilter extends AbstractFilter
{

    public Collection|AnonymousResourceCollection $values;
    private Category|null $category;
    private SizeRepositoryInterface $sizeRepository;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(Category|null $category = null)
    {
        $this->category = $category;
        $this->sizeRepository = app()->make(SizeRepositoryInterface::class);
        $this->values = $this->getValues();
    }

    public function getValues(): AnonymousResourceCollection
    {
        return SizeResource::collection($this->sizeRepository->getSizeWithProductsCount());
    }
}
