<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
//            'paypal',
            'stripe',
            'cash',
//            'GPay',
//            'ApplePay',
//            'LiqPay',
//            'PrivatPay',
//            'NovaPay'
        ];

        foreach ($methods as $method) {
            PaymentMethod::create([
                'key' => $method
            ]);
        }
    }
}
