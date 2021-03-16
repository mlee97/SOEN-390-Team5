<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class DefaultSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultSale = new Sale();
        $defaultSale -> quantity_sold = 5;
//        $defaultSale -> bikes()->syncWithoutDetaching([1]); // Need to come back to this.

        $defaultSale -> save();
        $defaultSale->bikes()->save(['bike_id'=>2, 'sale_id'=>1]);

    }
}
