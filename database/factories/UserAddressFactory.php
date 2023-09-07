<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'city' => fake()->city,
            'street' => fake()->streetAddress,
            'house' => fake()->numberBetween(1, 100),
            'flat' => fake()->numberBetween(1, 100),
            'default' => false
        ];
    }
}
