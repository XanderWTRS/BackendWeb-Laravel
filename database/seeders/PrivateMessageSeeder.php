<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrivateMessage;
use App\Models\User;
use Faker\Factory as Faker;

class PrivateMessageSeeder extends Seeder
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

        foreach ($users as $fromUser) {
            for ($i = 0; $i < 5; $i++) { // 5 berichten per gebruiker
                $toUser = $users->where('id', '!=', $fromUser->id)->random();

                PrivateMessage::create([
                    'from_user_id' => $fromUser->id,
                    'to_user_id' => $toUser->id,
                    'message' => $faker->sentence(10),
                    'is_read' => $faker->boolean(30),
                ]);
            }
        }
    }
}

