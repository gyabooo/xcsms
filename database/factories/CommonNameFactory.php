<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CommonName::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'virtualdomain_id' => factory(App\Models\Virtualdomain::class)->create()->id,
        'created_at' => $faker->dateTime('now', 'Asia/Tokyo'),
    ];
});
