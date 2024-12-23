<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserQuestion;
use App\Models\User;
use Faker\Factory as Faker;

class UserQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();

        if ($users->count() < 1) {
            $this->command->warn('Zorg ervoor dat er minstens 1 gebruiker in de database is.');
            return;
        }

        // Voeg 5 willekeurige vragen toe
        for ($i = 0; $i < 5; $i++) {
            UserQuestion::create([
                'user_id' => $users->random()->id,
                'question' => $faker->sentence(10),
            ]);
        }
    }
}
