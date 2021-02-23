<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class DefaultMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $defaultMaterial = new Material();
        $defaultMaterial -> material_name = 'Leather';
        $defaultMaterial -> material_quantity_in_stock = 4;

        $defaultMaterial->save();
    }
}
