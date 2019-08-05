<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Virtualdomain::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'created_at' => $faker->dateTime('now', 'Asia/Tokyo'),
    ];
});
