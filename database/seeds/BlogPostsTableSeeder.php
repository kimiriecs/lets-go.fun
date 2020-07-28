<?php

use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Factory;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\BlogPost::class, 100)->create();
    }
}
