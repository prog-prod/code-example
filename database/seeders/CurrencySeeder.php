<?php

namespace Database\Seeders;

use App\Enums\CurrencyEnum;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $now = now();
        $countries = Country::whereIn('code', ['UA', 'US'])->select(['code'])->get();
//        $countries = LocalesEnum::getKeys();
        foreach ($countries as $country) {
            $currency = CurrencyEnum::getByCountry($country->code);
//            $currency = CurrencyEnum::getByCountry($country);
            $data[] = [
                'name' => $currency->value,
                'code' => $currency->name,
                'symbol' => $currency->symbol(),
                'country' => $country->code,
//                'country' => $country,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Currency::insert($data);
    }
}
