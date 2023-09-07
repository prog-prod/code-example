<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method array getItems()
 * @method int countItems()
 *
 * @see \App\Services\CartService
 */
class CartServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
