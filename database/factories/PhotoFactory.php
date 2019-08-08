<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first() ?? factory(User::class),
        'path' => $faker->imageUrl
    ];
});
