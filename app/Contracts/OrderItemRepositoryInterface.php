<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface OrderItemRepositoryInterface
{
    public function createOrderItems(array $items): bool;

    public function removeOrderItems(Collection $orderItems);

}
