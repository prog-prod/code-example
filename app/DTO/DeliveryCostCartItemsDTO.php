<?php

namespace App\DTO;

class DeliveryCostCartItemsDTO
{
    public string $product;
    public string $quantity;

    /**
     * @param string $product
     * @param string $quantity
     */
    public function __construct(string $product, string $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
}
