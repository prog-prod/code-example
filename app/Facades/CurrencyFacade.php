<?php

namespace App\Facades;

use App\DTO\ExchangeRateDTO;
use App\DTO\PriceDTO;
use App\Enums\CurrencyEnum;
use Brick\Money\Money;
use Illuminate\Support\Facades\Facade;

/**
 * @method array getCurrencies()
 * @method array getCurrenciesObjects()
 * @method void setCurrency(string $currency, bool $rewriteSession = true)
 * @method CurrencyEnum getCurrency()
 * @method string getFallbackCurrency()
 * @method Money convertPrice(Money $price, string|null $currency = null)
 * @method ExchangeRateDTO getExchangeRate()
 * @method PriceDTO getPriceObject(Money $price)
 * @method Money moneyDecorator(string|int $price, string|null $currency = null)
 * @method PriceDTO getMinPriceLimitForFilter()
 * @method PriceDTO getMaxPriceLimitForFilter()
 *
 * @see \App\Services\CurrencyService
 */
class CurrencyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'currency';
    }
}
