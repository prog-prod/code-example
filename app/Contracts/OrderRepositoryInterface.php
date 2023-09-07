<?php

namespace App\Contracts;

interface OrderRepositoryInterface
{
    public function createOrder(array $data);

    public function getOrderById($orderId);

    public function getLastOrder();

}
