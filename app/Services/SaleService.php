<?php

namespace App\Services;

use App\Contracts\SaleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SaleService
{
    private SaleRepositoryInterface $repository;

    /**
     * Create a new SaleService instance.
     *
     */
    public function __construct()
    {
        $this->repository = app(SaleRepositoryInterface::class);
    }

    /**
     * Get the sales.
     *
     * @return Collection The collection of sales.
     */
    public function getSales(): Collection
    {
        return $this->repository->getSales();
    }

    /**
     * Calculate the discount percentage based on the product price and discount amount.
     *
     * @param int $productPrice The original price of the product.
     * @param int $discount The discount amount.
     * @return int The discount percentage rounded to the nearest whole number.
     */
    public function getPercent(int $productPrice, int $discount): int
    {
        return round($discount * 100 / $productPrice);
    }
}
