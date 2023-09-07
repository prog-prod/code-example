<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        https://restcountries.com/v2/all?fields=name,alpha2Code
        $countries = json_decode(file_get_contents(__DIR__ . '/countries.json'));

        $data = [];
        $now = now();
        foreach ($countries as $country) {
            $data[] = [
                'name' => $country->name,
                'code' => $country->alpha2Code,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        Country::insert($data);
    }
}
