<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//use App\Models\BlogPost;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\BlogPost::class, function (Faker $faker) {
    //$titleLength = rand(3, 8);
    $title = $faker->sentence(rand(2, 4), true);
    //$txtLength = rand(100, 400);
    $txt = $faker->realtext(rand(1000, 1500));
    $createdAt = $faker->dateTimeBetween('-3 month', '-2 month');
    $isPublished = rand(1, 5) > 1;

    $data = [
        'user_id' => (rand(1, 5) == 5) ? 1 : 2,
        'category_id' => rand(1, 11),
        'slug' => Str::slug($title),
        'title' => $title,
        'excerpt' => $faker->text(rand(40, 100)),
        'content_raw' => $txt,
        'content_html' => $txt,
        'is_published' => $isPublished,
        'published_at' => $isPublished ? $faker->dateTimeBetween('-2 month', '-1 day') : null,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
    return $data;
});
