<?php

use App\Podcast;
use Illuminate\Database\Seeder;

class PodcastTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Podcast::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 10; $i++) {
            Podcast::create([
                'name' => $faker->sentence,
                'description' => $faker->paragraph,
                'marketing_url' => $faker->url,
                'feed_url' => $faker->url,
            ]);
        }
    }
}
