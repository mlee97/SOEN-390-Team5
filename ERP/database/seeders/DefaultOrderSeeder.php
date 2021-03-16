<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class DefaultOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $defaultMaterial1 = new Order();
        $defaultMaterial1 -> ETA = '2021-06-21';
        $defaultMaterial1 -> status = 'received';
        $defaultMaterial1 -> order_quantity = 720;

        $defaultMaterial2 = new Order();
        $defaultMaterial2 -> ETA = '2021-09-19';
        $defaultMaterial2 -> status = 'in transit';
        $defaultMaterial2 -> order_quantity = 500;

        $defaultMaterial3 = new Order();
        $defaultMaterial3 -> ETA = '2021-08-13';
        $defaultMaterial3 -> status = 'received';
        $defaultMaterial3 -> order_quantity = 1000;

        $defaultMaterial4 = new Order();
        $defaultMaterial4 -> ETA = '2021-10-04';
        $defaultMaterial4 -> status = 'in transit';
        $defaultMaterial4 -> order_quantity = 900;

        $defaultMaterial1->save();
        $defaultMaterial2->save();
        $defaultMaterial3->save();
        $defaultMaterial4->save();
    }
}

?>