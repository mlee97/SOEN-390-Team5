<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this-> call(MasterUserSeeder::class);
        $this->call(Bike_Parts_MaterialOrderSeeder::class);
        //$this-> call(DefaultJobSeeder::class);

    }
}
