<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum SortEnum: int
{
    use EnumTrait;

    case TOP_PRODUCTS_ASC = 1;
    case TOP_PRODUCTS_DESC = -1;
    case POPULAR_ASC = 2;
    case POPULAR_DESC = -2;
    case FROM_CHEAP_TO_EXPENSIVE_ASC = 3;
    case FROM_CHEAP_TO_EXPENSIVE_DESC = -3;
    case ALPHABETICALLY_ASC = 4;
    case ALPHABETICALLY_DESC = -4;
    case NEWEST = 5;

    public function getColumnName()
    {
        switch ($this) {
            case self::TOP_PRODUCTS_DESC:
            case self::TOP_PRODUCTS_ASC:
                return 'rating';
            case self::POPULAR_DESC:
            case self::POPULAR_ASC:
                return 'views';
            case self::FROM_CHEAP_TO_EXPENSIVE_DESC:
            case self::FROM_CHEAP_TO_EXPENSIVE_ASC:
                return 'price';
            case self::ALPHABETICALLY_DESC:
            case self::ALPHABETICALLY_ASC:
                return 'name';
            case self::NEWEST:
                return 'created_at';
        }
    }

}
