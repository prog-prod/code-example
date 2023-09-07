<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method void setLocale(string $lang, bool $rewriteSession = true)
 * @method array getLocales()
 * @method string getLocale()
 * @method string getFallbackLocale()
 *
 * @see \App\Services\LocaleService
 */
class LocaleFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'locale';
    }
}
