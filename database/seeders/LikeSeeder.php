<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;
use App\Models\NewsItem;
use App\Models\User;

class LikeSeeder extends Seeder
{
    public function run()
    {
        $newsItems = NewsItem::all();
        $users = User::all();

        foreach ($newsItems as $newsItem) {
            $users->random(rand(1, $users->count()))->each(function ($user) use ($newsItem) {
                Like::create([
                    'news_item_id' => $newsItem->id,
                    'user_id' => $user->id,
                ]);
            });
        }
    }
}
