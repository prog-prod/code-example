<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method bool isNotProduction()
 * @method bool isProduction()
 * @method string translit(string|null $text = null)
 * @method bool isTranslited(string|null $text = null)
 * @method string detranslit(string|null $text = null)
 *
 * @see \App\Services\HelperService
 */
class HelperServiceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'helper';
    }
}
