<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'tutor' => $faker->name($gender = null),
        'duration' => $faker->text($maxNbChars = 50),
        'text' => $faker->text($maxNbChars = 100),
    ];
});
