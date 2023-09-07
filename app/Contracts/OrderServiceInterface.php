<?php

namespace App\Contracts;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderServiceInterface
{
    public function generateOrderNumber(Customer $customer): string;

    public function createOrder(Customer $customer, array $data);

    public function setOrderCanceled(Order $order, string $reason);

    public function confirmOrder(Order $order): bool;

    public function countOrderTotalPrice(array|Collection $products, array $quantityMapper): int;

    public function getOrderItemsData(Order $order, Collection $products, array $quantityMapper): array;
}
