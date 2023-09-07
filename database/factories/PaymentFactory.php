<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'payment_method_id' => PaymentMethod::query()->inRandomOrder()->first()?->id,
            'status' => $this->faker->numberBetween(1, 5),
            'order_id' => Order::query()->inRandomOrder()->first()->id,
            'amount' => $this->faker->numberBetween(1000, 100000),
        ];
    }
}
