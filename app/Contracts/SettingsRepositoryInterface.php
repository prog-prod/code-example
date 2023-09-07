<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface SettingsRepositoryInterface
{
    public function getSetting(string $name): null|Model;

    public function setSetting(string $name, mixed $value);
}
