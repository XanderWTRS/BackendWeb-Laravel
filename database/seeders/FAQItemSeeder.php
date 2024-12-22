<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FAQItem;
use App\Models\Category;
use Faker\Factory as Faker;

class FAQItemSeeder extends Seeder
{
    public function run()   //10 FAQITEMS
    {
        $faker = Faker::create();
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found. Run the CategorySeeder first.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            FAQItem::create([
                'category_id' => $categories->random()->id,
                'question' => $faker->sentence(),
                'answer' => $faker->paragraph(),
            ]);
        }
    }
}
