<?php

namespace App\Repositories;

use App\Contracts\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function updateOrCreateCustomer(array $data)
    {
        $conditions = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ];

        // Update or create the customer based on the provided conditions
        return Customer::updateOrCreate($conditions, $data);
    }

    public function getAllCustomers(): Collection
    {
        return Customer::all();
    }
}
