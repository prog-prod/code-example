<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method int getComparisonsItemsCount()
 *
 * @see \App\Services\ComparisonsService
 */
class ComparisonsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'comparisons';
    }
}
