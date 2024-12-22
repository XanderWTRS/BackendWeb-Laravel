<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\NewsItem;
use App\Models\User;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $newsItems = NewsItem::all();
        $users = User::all();

        foreach ($newsItems as $newsItem) {
            $users->random(rand(1, $users->count()))->each(function ($user) use ($newsItem, $faker) {
                Comment::create([
                    'news_item_id' => $newsItem->id,
                    'user_id' => $user->id,
                    'content' => $faker->sentence(rand(5, 15)),
                ]);
            });
        }
    }
}

