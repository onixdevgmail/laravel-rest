<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PodcastTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
