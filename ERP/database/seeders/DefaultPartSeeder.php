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
        $defaultPart -> part_quantity_in_stock = '2';

        $defaultPart->save();
    }
}
