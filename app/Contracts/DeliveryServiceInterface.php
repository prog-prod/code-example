<?php

namespace App\Contracts;


use App\Models\Delivery;
use Illuminate\Database\Eloquent\Collection;

interface DeliveryServiceInterface
{
    public function getMethods(): Collection;

    public function getMethodsString();

    public function findDeliveryByKey(string $key);

    public function getShippingDate(Delivery $delivery);
}
