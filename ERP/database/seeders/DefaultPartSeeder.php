<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;

class DefaultPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $defaultPart = new Part();
        $defaultPart -> part_name = 'wheel';
        $defaultBike -> part_quantity_in_stock = 2;

        if($part == null)
            $defaultPart->save();
    }
}
