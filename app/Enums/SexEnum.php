<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum SexEnum: int
{
    use EnumTrait;

    case MAN = 1;
    case WOMAN = 2;
}
