<?php

use Illuminate\Database\Seeder;

class CommonnameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Commonname::class, 10)->create();
    }
}
