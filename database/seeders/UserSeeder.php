<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            User::create([
                'name' => $faker->name,
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->safeEmail,
                'verjaardag' => $faker->date,
                'profielfoto' => null,
                'bio' => $faker->sentence,
                'password' => Hash::make('password'),
                'isAdmin' => false,
            ]);
        }
    }
}
