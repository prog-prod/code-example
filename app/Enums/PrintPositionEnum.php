<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum PrintPositionEnum: int
{
    use EnumTrait;
    
    case FRONT_TOP = 1;
    case FRONT_BOTTOM = 2;
    case FRONT_LEFT = 3;
    case FRONT_RIGHT = 4;
    case FRONT_CENTER = 5;

    case BACK_TOP = 6;
    case BACK_BOTTOM = 7;
    case BACK_LEFT = 8;
    case BACK_RIGHT = 9;
    case BACK_CENTER = 10;

    case FRONT_CUSTOM = 11;
    case BACK_CUSTOM = 12;

}
