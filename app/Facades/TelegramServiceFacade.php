<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method int getPercent(int $productPrice, int $discount)
 * @method int getSales(int $productPrice, int $discount)
 *
 * @see \App\Services\TelegramService
 */
class TelegramServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'telegram';
    }
}
