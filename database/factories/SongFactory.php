<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Song;
use Faker\Generator as Faker;

$factory->define(Song::class, function (Faker $faker) {
    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    return [
        'name' => $faker->name,
        'other_name' => $faker->name,
        'thumbnail' => $faker->imageUrl(),
        'url' => $faker->url,
        'year' => $faker->year,
        'views' => $faker->randomNumber(),
        'category_id' => Category::inRandomOrder()->first()->id,
    ];
});
