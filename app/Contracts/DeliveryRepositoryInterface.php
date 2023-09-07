<?php

namespace App\Contracts;

interface DeliveryRepositoryInterface
{
    public function getDeliveryMethods();

    public function findDeliveryByKey($key);
}
