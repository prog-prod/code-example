<?php

namespace App\Facades;

use App\DTO\Monobank\MonoAccountDTO;
use Illuminate\Support\Facades\Facade;

/**
 * @method MonoAccountDTO|null findAccount(string $accountId)
 * @see \App\Services\MonobankService
 */
class MonobankServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'monobank';
    }
}
