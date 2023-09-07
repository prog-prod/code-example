<?php

namespace App\Contracts;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;

interface PaymentMethodRepositoryInterface
{
    public function getPaymentMethods();

    public function getPaymentMethodByKey(string $key): ?PaymentMethod;

    public function getAllPaymentMethods(): Collection;
}
