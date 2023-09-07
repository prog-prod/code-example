<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MenuSeeder::class,
            CategorySeeder::class,
            PrintCategorySeeder::class,
            CountrySeeder::class,
            CurrencySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            PrintImageSeeder::class,
            TagSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductFeatureSeeder::class,
            SaleSeeder::class,
            SubscriberSeeder::class,
            FilterSeeder::class,
            CustomerSeeder::class,
            ReviewSeeder::class,
            OrderSeeder::class,
            CartSeeder::class,
            GenerateUserAvatarsSeeder::class,
            RelatedProductSeeder::class,
            AdminUserSeeder::class,
            SliderSeeder::class,
            PaymentMethodSeeder::class,
        ]);
    }
}
