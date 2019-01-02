<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\JobSeeker::class, function (Faker $faker) {
    return [
        'commcare_id' => $faker->slug
    ];
});
