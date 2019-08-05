<?php

use Illuminate\Database\Seeder;

class CertificateServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CertificateService::class, 10)->create();
    }
}
