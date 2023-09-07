<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum PrintSizeEnum: int
{
    use EnumTrait;

    case XXL = 1;
    case XL = 2;
    case MD = 3;
    case SM = 4;
    case XS = 5;
}
