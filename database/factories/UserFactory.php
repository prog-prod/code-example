<?php

namespace Database\Factories;

use App\Enums\SexEnum;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $country = Country::all()->random();
        $phone = fake()->unique()->phoneNumber;
        $phone_verified_at = collect([fake()->date, null])->random();
        return [
            'email' => fake()->unique()->safeEmail(),
            'login' => fake()->unique()->userName,
            'sex' => SexEnum::random()->value,
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'middle_name' => null,
            'country_code' => $country->code,
            'birthday' => fake()->date,
            'phone' => $phone_verified_at ? $phone : null,
            'phone_verified_at' => $phone_verified_at,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
