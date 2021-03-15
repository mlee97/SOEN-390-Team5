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
        $this-> call(DefaultBikeSeeder::class);
        $this-> call(DefaultPartSeeder::class);
        $this-> call(DefaultMaterialSeeder::class);
        $this-> call(DefaultJobSeeder::class);
        $this-> call(DefaultOrderSeeder::class);
    }
}
