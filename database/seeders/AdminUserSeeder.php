<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUser::create([
            'name' => 'Admin',
            'email' => config('app.admin.email'),
            'password' => Hash::make(config('app.admin.password'))
        ]);
        AdminUser::create([
            'name' => 'Inna Olskaya',
            'email' => 'innaolskaya@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
