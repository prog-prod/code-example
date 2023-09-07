<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum ReasonsCancelOrderEnum: string
{
    use EnumTrait;

    case REJECTION_BY_CLIENT = 'rejection_by_client';
    case OUT_OF_STOCK = 'out_of_stock';
    case PRODUCT_NOT_PAID = 'products_not_paid';
    case OTHER = 'other';

    public function getLabel(): string
    {
        switch ($this) {
            case self::REJECTION_BY_CLIENT:
                return 'Відмова клієнта';
            case self::OUT_OF_STOCK:
                return 'Товару нема в наявності';
            case self::PRODUCT_NOT_PAID:
                return 'Товар не оплачено';
            default:
            case self::OTHER:
                return 'Інша причина';
        }
    }
}
