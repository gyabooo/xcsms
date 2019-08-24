<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Certificate::class, function (Faker $faker) {
    $dir = './storage/faker';
    $width = $height = 120;

    return [
        'expiration_date' => $faker->dateTime('now', 'Asia/Tokyo'),
        'save_dir_path' => '/test/',
        'csr' => $faker->image($dir, $width, $height, 'cats', false),
        'cacert' => $faker->image($dir, $width, $height, 'cats', false),
        'crt' => $faker->image($dir, $width, $height, 'cats', false),
        'key' => $faker->image($dir, $width, $height, 'cats', false),
        'certificate_service_id' => APP\Models\CertificateService::pluck('id')->random(),
        'commonname_id' => APP\Models\Commonname::pluck('id')->random(),
        'created_at' => $faker->dateTime('now', 'Asia/Tokyo'),
    ];
});
