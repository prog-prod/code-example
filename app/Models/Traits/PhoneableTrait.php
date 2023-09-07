<?php

namespace App\Models\Traits;

use App\Services\PhoneConfirmationService;

trait PhoneableTrait
{
    public function getCleanedPhoneAttribute(): string|null
    {
        if ($this->phone) {
            return PhoneConfirmationService::clearPhone($this->phone);
        }
        return null;
    }
}
