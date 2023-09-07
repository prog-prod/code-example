<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum FilterEnum: int
{
    use EnumTrait;

    case BRAND = 1;
    case COLOR = 2;
    case SIZE = 3;
    case PRICE = 4;
    case SEX = 5;
    case FASHION = 6;
    case COMPOSITION = 7;
    case ACCESSORIES = 8;
    case TAGS = 9;
    case PRINTS = 10;
}
