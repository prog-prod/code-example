<?php

namespace App\Facades;

use App\Models\Order;
use Illuminate\Support\Facades\Facade;

/**
 * @method string generateOrderNumber(Order $order)
 *
 * @see \App\Services\OrderService
 */
class OrderServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'order';
    }
}
