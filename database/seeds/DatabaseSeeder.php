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
        // $this->call(UsersTableSeeder::class);
        // $this->call(BlogCategoriesTableSeeder::class);
        $this->call(BlogPostsTableSeeder::class);
        // factory(\App\Models\BlogPost::class, 5)->create();
    }
}
