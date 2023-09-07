<?php

namespace App\Contracts;

interface CustomerRepositoryInterface
{
    public function updateOrCreateCustomer(array $data);

    public function getAllCustomers();
}
