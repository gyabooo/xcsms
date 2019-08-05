<?php

use Illuminate\Database\Seeder;

class VirtualdomainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Virtualdomain::class, 10)->create();
    }
}
