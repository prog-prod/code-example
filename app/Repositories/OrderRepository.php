<?php

namespace App\Repositories;

use App\Contracts\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder(array $data)
    {
        return Order::query()->create($data);
    }

    public function getOrderById($orderId): Model|Collection|Builder|array|null
    {
        return Order::query()->find($orderId);
    }

    public function getLastOrder()
    {
        return Order::query()->latest()->limit(1)->get()->first();
    }
}
