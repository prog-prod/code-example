<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GenderFactory extends Factory
{
    protected $model = Gender::class;

    public function definition(): array
    {
        return [
            'key' => collect(GenderEnum::getKeys())->random(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
