<?php

use App\Comments;
use App\Podcast;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comments::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 10; $i++) {
            Comments::create([
                'author_name' => $faker->name.$i,
                'author_email' => $faker->email,
                'comment' => $faker->sentence,
                'podcast_id' => array_rand(Podcast::all()->pluck('id')->toArray(), 1),
            ]);
        }
    }
}
