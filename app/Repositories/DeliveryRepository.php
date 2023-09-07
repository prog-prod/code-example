<?php

namespace App\Repositories;

use App\Contracts\DeliveryRepositoryInterface;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Collection;

class DeliveryRepository implements DeliveryRepositoryInterface
{

    public function getDeliveryMethods(): Collection
    {
        return Delivery::all();
    }

    public function findDeliveryByKey($key)
    {
        return Delivery::query()->where('key', $key)->get()->first();
    }
}
