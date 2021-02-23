<?php

namespace Database\Seeders;

use App\Models\Bike;
use Illuminate\Database\Seeder;

class DefaultBikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultBike = new Bike();
        $defaultBike -> type = 'street';
        $defaultBike -> size = '18';
        $defaultBike -> color = 'Red';
        $defaultBike -> finish = 'Chrome';
        $defaultBike -> grade = 'Carbon';
        $defaultBike -> quantity_in_stock = 5;

        $defaultBike->save();
    }
}