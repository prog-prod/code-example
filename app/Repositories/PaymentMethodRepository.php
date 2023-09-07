<?php

namespace App\Repositories;

use App\Contracts\PaymentMethodRepositoryInterface;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{

    public function getPaymentMethods(): Collection
    {
        return PaymentMethod::all();
    }

    public function getPaymentMethodByKey(string $key): ?PaymentMethod
    {
        return PaymentMethod::query()->where('key', $key)->get()->first();
    }

    public function getAllPaymentMethods(): Collection
    {
        return PaymentMethod::all();
    }
}
