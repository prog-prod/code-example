<?php

namespace Database\Seeders;

use App\Models\User;
use File;
use Illuminate\Database\Seeder;

class GenerateUserAvatarsSeeder extends Seeder
{
    private $directoryPath = 'public/storage/images/avatars';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if (!File::exists($this->directoryPath)) {
            File::makeDirectory($this->directoryPath, 0755, true, true);
        }

        foreach ($users as $user) {
            $user->avatar = fake()->image($this->directoryPath, 100, 100, null, false);
            $user->save();
        }
    }
}
