<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(1)->create([
            'email' => config('app.admin.email'),
            'password' => Hash::make(config('app.admin.password'))
        ]);
        User::factory()->count(9)->create([
            'password' => Hash::make('password'),
        ]);
    }
}
