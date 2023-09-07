<?php

namespace App\DTO\NovaPoshta;

class NpDeliveryDateDTO
{
    public object $deliveryDate;

    /**
     * @param object $deliveryDate
     */
    public function __construct(object $deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    }
}
