<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method int getPhoneLength()
 * @method int getPhoneCodeLength()
 * @method int getPhoneCodeFormattedLength()
 * @method int getMaxFormattedCharactersLength()
 *
 * @see \App\Services\PhoneConfirmationService
 */
class PhoneConfirmationFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'phoneConfirmation';
    }
}
