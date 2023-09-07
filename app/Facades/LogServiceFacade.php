<?php

namespace App\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method void logPhoneCode(string $phone, string $code)
 * @method Model getPhoneCodeLogByPhone(string $phone)
 * @method void info($message)
 *
 * @see \App\Services\LogService
 */
class LogServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'logService';
    }
}
