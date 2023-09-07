<?php

namespace App\Enums;

use App\Enums\Traits\EnumTrait;

enum CurrencyEnum: string
{

    use EnumTrait;

    case UAH = 'uah';
    case USD = 'usd';

    public function symbol(): string
    {
        switch ($this) {
            case self::UAH:
                return '₴';
            case self::USD:
                return '$';
            default:
                return '';
        }
    }

    public function getCodeISO()
    {
        switch ($this) {
            case self::USD:
                return 840;
            case self::UAH:
            default:
                return 980;
        }
    }

    public static function getCurrencyByISO(int $code): CurrencyEnum
    {
        switch ($code) {
            case 840:
                return self::USD;
            case 980:
            default:
                return self::UAH;
        }
    }

    public function exchargedCurrency(): CurrencyEnum
    {
        switch ($this) {
            case self::UAH:
                return self::USD;
            case self::USD:
            default:
                return self::UAH;
        }
    }

    public static function getByCountry($country): CurrencyEnum
    {
        switch ($country) {
            case "UA":
                return self::UAH;
            default:
                return self::USD;
        }
    }
}
