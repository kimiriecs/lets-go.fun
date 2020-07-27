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
                // DB::disableQueryLog();
        factory(\App\Models\BlogPost::class, 5)->create();
    }
}
