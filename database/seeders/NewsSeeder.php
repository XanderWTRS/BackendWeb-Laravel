<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()   //10 NEWS ITEMS
    {
        $faker = Faker::create();

        $newsItems = [];

        for ($i = 1; $i <= 10; $i++) {
            $newsItems[] = [
                'title' => $faker->sentence(6),
                'content' => $faker->paragraph(10),
                'image' => 'uploads/news_images/' . $faker->lexify('image_?????.jpg'),
                'publication_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('news_items')->insert($newsItems);
    }
}
