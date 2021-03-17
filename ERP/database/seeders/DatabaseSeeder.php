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

        $this->call(Bike_Parts_Material_Order_Sale_Seeder::class);
        //$this-> call(DefaultJobSeeder::class);
    }
}
