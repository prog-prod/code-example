<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum LocalesEnum: string
{
    use EnumTrait;

    case UA = 'uk';
    case EN = 'en';

}
