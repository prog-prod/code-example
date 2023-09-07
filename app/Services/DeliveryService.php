<?php

namespace App\Services;

use App\Contracts\DeliveryRepositoryInterface;
use App\Contracts\DeliveryServiceInterface;
use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class DeliveryService implements DeliveryServiceInterface
{

    private DeliveryRepositoryInterface $repository;

    public function __construct(DeliveryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getMethods(): Collection
    {
        return $this->repository->getDeliveryMethods();
    }

    public function getMethodsString(): string
    {
        return $this->getMethods()->pluck('key')->join(',');
    }

    public function findDeliveryByKey(string $key)
    {
        return $this->repository->findDeliveryByKey($key);
    }

    public function getShippingDate(Delivery $delivery): string
    {
        $now = now();
        $hour = now()->hour;
        $limitHour = Carbon::parse($delivery->params['shipping_to_time'])->hour;

        if ($hour < $limitHour) {
            $day = $now;
        } else {
            $day = $now->addDay();
        }
        return $day->format('d.m.Y');
    }
}
