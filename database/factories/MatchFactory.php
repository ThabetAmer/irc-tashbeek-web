<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Match::class, function (Faker $faker) {
    return [
        'commcare_id' => $faker->randomAscii
    ];
});
