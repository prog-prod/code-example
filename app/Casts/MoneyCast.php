<?php

namespace App\Casts;

use App\Enums\CurrencyEnum;
use App\Facades\CurrencyFacade;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Exception\RoundingNecessaryException;
use Brick\Math\RoundingMode;
use Brick\Money\Context\CustomContext;
use Brick\Money\Exception\UnknownCurrencyException;
use Brick\Money\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    /**
     * @param $model
     * @param $key
     * @param $value
     * @param $attributes
     * @return Money
     * @throws UnknownCurrencyException
     * @throws RoundingNecessaryException|NumberFormatException
     */
    public function get($model, $key, $value, $attributes)
    {
        if (!$value && in_array($key, ['min_price', 'max_price'])) {
            return $value;
        }
        $value = Money::ofMinor($value, CurrencyEnum::UAH->name, new CustomContext(0), RoundingMode::UP);
        if (CurrencyFacade::getCurrency()->name !== CurrencyEnum::UAH->name) {
            return CurrencyFacade::convertPrice($value);
        }

        return $value;
    }

    public function set($model, $key, $value, $attributes)
    {
        if ($value instanceof Money) {
            return $value->getAmount();
        }

        return $value;
    }
}
