<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileMessage;
use App\Models\User;
use Faker\Factory as Faker;

class ProfileMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        if ($users->count() < 2) {
            $this->command->warn('Zorg ervoor dat er minstens 2 gebruikers in de database zijn.');
            return;
        }

        foreach ($users as $toUser) {
            for ($i = 0; $i < 5; $i++) {        //5 BERICHTEN PER GEBRUIKER
                ProfileMessage::create([
                    'to_user_id' => $toUser->id,
                    'from_user_id' => $users->random()->id,
                    'message' => $faker->sentence(10),
                ]);
            }
        }
    }
}
