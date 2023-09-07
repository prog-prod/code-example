<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method string getLogin()
 * @method string getParams()
 *
 * @see \App\Services\InstagramService
 */
class InstagramFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'instagram';
    }
}
