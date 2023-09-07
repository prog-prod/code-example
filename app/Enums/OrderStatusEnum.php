<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum OrderStatusEnum: string
{
    use EnumTrait;

    case CANCELED = '0';
    case PENDING = '1';
    case PENDING_PAYMENT = '2';
    case PROCESSING = '3';
    case SHIPPED = '4';
    case DELIVERED = '5';
    case DONE = '6';

    public function getLabel(): string
    {
        switch ($this) {
            default:
            case self::PENDING:
                return __('order.status.PENDING');
            case self::PENDING_PAYMENT:
                return __('order.status.PENDING_PAYMENT');
            case self::PROCESSING:
                return __('order.status.PROCESSING');
            case self::SHIPPED:
                return __('order.status.SHIPPED');
            case self::DELIVERED:
                return __('order.status.DELIVERED');
            case self::DONE:
                return __('order.status.DONE');
            case self::CANCELED:
                return __('order.status.CANCELED');
        }
    }
}
