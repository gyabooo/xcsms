<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Vendor::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'created_at' => $faker->dateTime('now', 'Asia/Tokyo'),
    ];
});
