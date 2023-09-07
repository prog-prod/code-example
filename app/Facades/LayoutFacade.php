<?php

namespace App\Facades;

use App\Models\Layout;
use Illuminate\Support\Facades\Facade;

/**
 * @method Layout|null getSettings()
 *
 * @see \App\Services\LayoutService
 */
class LayoutFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'layout';
    }
}
