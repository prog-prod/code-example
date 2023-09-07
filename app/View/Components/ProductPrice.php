<?php

namespace App\View\Components;

use Brick\Money\Money;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductPrice extends Component
{
    public Money|null $price;
    public Money|null $priceWithDiscount;
    public string $currency;
    public bool $styled;

    public function __construct($price, $currency, $priceWithDiscount = null, $styled = false)
    {
        $this->price = $price;
        $this->currency = \App\Enums\CurrencyEnum::from($currency)->symbol();
        $this->priceWithDiscount = $priceWithDiscount;
        $this->styled = $styled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $price = $this->price->getAmount()->toInt();
        $priceWithDiscount = $this->priceWithDiscount?->getAmount()->toInt();

        return view('components.product-price', [
            'price' => number_format($price, 2),
            'priceWithDiscount' => $priceWithDiscount ? number_format($priceWithDiscount, 2) : null,
            'currency' => $this->currency,
            'styled' => $this->styled
        ]);
    }
}
