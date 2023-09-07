<?php

namespace App\Facades;

use App\DTO\MenuDTO;
use Illuminate\Support\Facades\Facade;

/**
 * @method MenuDTO getMenu()
 * @method array getSocialNetworks()
 * @method array getSiteSettings()
 *
 * @see \App\Services\CommonService
 */
class CommonFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'common';
    }
}
