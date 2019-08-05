<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(VendorTableSeeder::class);
        $this->call(CertificateServiceTableSeeder::class);
        $this->call(CommonNameTableSeeder::class);
        $this->call(CertificateTableSeeder::class);
        // $certificate_service_ids = APP\CertificateService::pluck('id');
        // $certificate_ids = APP\Certificate::pluck('id');
    }
}
