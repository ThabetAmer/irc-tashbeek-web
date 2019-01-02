<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Firm::class, function (Faker $faker) {
    return [
        'commcare_id' => $faker->slug
    ];
});
