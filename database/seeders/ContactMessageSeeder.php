<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ContactMessageSeeder extends Seeder
{
    public function run(): void //10 CONTACT MESSAGES
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('contact_messages')->insert([
                'name' => $faker->name(),
                'email' => $faker->safeEmail(),
                'message' => $faker->sentence(15),
                'answered' => $faker->boolean(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
