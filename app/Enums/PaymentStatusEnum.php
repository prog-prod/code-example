<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum PaymentStatusEnum: int
{
    use EnumTrait;

    case PENDING = 0;
    case SUCCESS = 1;
    case FAILED = 2;
    case CANCELED = 3;
    case PARTIALLY_PAID = 4;
    case OVERPAID = 5;

    public function getLabel(): string
    {
        switch ($this) {
            default:
            case self::PENDING:
                return __("payment.status.PENDING");
            case self::SUCCESS:
                return __("payment.status.SUCCESS");
            case self::FAILED:
                return __("payment.status.FAILED");
            case self::CANCELED:
                return __("payment.status.CANCELED");
            case self::PARTIALLY_PAID:
                return __("payment.status.PARTIALLY_PAID");
            case self::OVERPAID:
                return __("payment.status.OVERPAID");
        }
    }
}
