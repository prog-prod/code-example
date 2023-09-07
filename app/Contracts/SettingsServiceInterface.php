<?php

namespace App\Contracts;

use App\Models\Setting;

interface SettingsServiceInterface
{
    public function getCitySender(): ?Setting;
}
