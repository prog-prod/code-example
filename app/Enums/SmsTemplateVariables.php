<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum SmsTemplateVariables: string
{
    use EnumTrait;

    case TOTAL_PRICE = 'total_price';
    case PHONE = 'phone';
    case ORDER_NUMBER = 'order_number';
    case ORDER_STATUS = 'order_status';
    case CURRENCY = 'currency';
    case WORK_PHONE = 'work_phone';

    public function getOrderField(): string
    {
        switch ($this) {
            default:
            case self::TOTAL_PRICE:
                return "total_price";
            case self::PHONE:
                return "phone";
            case self::ORDER_NUMBER:
                return "id";
            case self::ORDER_STATUS:
                return "status";
            case self::CURRENCY:
                return "currency_name";
        }
    }

    public function getLabel(): string
    {
        switch ($this) {
            default:
            case self::TOTAL_PRICE:
                return "Ціна замовлення";
            case self::PHONE:
                return "Телефон замовника";
            case self::ORDER_NUMBER:
                return "Номер замовлення";
            case self::ORDER_STATUS:
                return "Статус замовлення";
            case self::CURRENCY:
                return "Валюта";
            case self::WORK_PHONE:
                return "Рабочий номер телефона";
        }
    }
}
