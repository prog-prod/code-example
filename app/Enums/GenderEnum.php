<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum GenderEnum: int
{
    use EnumTrait;

    case MAN = 1;
    case WOMAN = 2;
    case CHILD = 3;
}
