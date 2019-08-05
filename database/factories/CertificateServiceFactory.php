<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CertificateService::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'vendor_id' => factory(App\Models\Vendor::class)->create()->id,
        'created_at' => $faker->dateTime('now', 'Asia/Tokyo'),
    ];
});
