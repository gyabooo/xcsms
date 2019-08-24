<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Vendor;
use App\Models\CertificateService;

class CertificateServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor_data = [
            [
                'name' => "Let's Encrypt",
            ],
            [
                'name' => 'DigiCert',
            ],
        ];

        $service_data = [
            [
                'name' => "Let's Encrypt",
                'vendor_id' => 1,
            ],
            [
                'name' => 'セキュア・サーバーID',
                'vendor_id' => 2,
            ],
            [
                'name' => 'グローバル・サーバーID',
                'vendor_id' => 2,
            ],
        ];

        foreach($vendor_data as $data) {
            Vendor::create(['name' => $data['name']]);
        }
        foreach($service_data as $data) {
            CertificateService::create(['name' => $data['name'], 'vendor_id' => $data['vendor_id']]);
        }

        // factory(App\Models\CertificateService::class, 10)->create();
    }
}
