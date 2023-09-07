<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method int getPercent(int $productPrice, int $discount)
 * @method int getSales(int $productPrice, int $discount)
 *
 * @see \App\Services\SaleService
 */
class SaleFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sale';
    }
}
