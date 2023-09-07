<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum DeliveryEnum: string
{
    use EnumTrait;

    case NOVAPOSHTA_DEPARTMENT = 'novaPoshta_department';
    case NOVAPOSHTA_COURIER = 'novaPoshta_courier';
}
