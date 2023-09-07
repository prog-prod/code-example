<?php

namespace App\Enums\NovaPoshta;

enum NpPaymentMethodEnum: string
{
    case CASH = 'Cash';
    case NON_CASH = 'NonCash';
}
