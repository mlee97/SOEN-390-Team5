<?php

namespace Database\Seeders;

use App\Models\Bike;
use App\Models\Material;
use App\Models\Order;
use App\Models\Part;
use App\Models\Sale;
use Illuminate\Database\Seeder;

class Bike_Parts_Material_Order_Sale_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //MATERIALS SEEDS=============================================
        $stainless_steel = new Material();
        $stainless_steel -> material_name = 'Stainless Steel';
        $stainless_steel -> material_quantity_in_stock = 1;
        $stainless_steel -> cost = 14.99;
        $materialFromDB = Material::where('material_name', '=', $stainless_steel->material_name)->first();
        if ($materialFromDB == null)
            $stainless_steel->save();

        $carbon_fiber = new Material();
        $carbon_fiber -> material_name = 'Carbon Fiber';
        $carbon_fiber -> material_quantity_in_stock = 1;
        $carbon_fiber -> cost = 34.99;
        $materialFromDB = Material::where('material_name', '=', $carbon_fiber->material_name)->first();
        if ($materialFromDB == null)
            $carbon_fiber->save();

        $titanium = new Material();
        $titanium -> material_name = 'Titanium';
        $titanium -> material_quantity_in_stock = 1;
        $titanium -> cost = 24.99;
        $materialFromDB = Material::where('material_name', '=', $titanium->material_name)->first();
        if ($materialFromDB == null)
            $titanium->save();

        $magnesium = new Material();
        $magnesium -> material_name = 'Magnesium';
        $magnesium -> material_quantity_in_stock = 1;
        $magnesium -> cost = 34.99;
        $materialFromDB = Material::where('material_name', '=', $magnesium->material_name)->first();
        if ($materialFromDB == null)
            $magnesium->save();

        $pure_aluminum = new Material();
        $pure_aluminum -> material_name = 'Pure Aluminum';
        $pure_aluminum -> material_quantity_in_stock = 1;
        $pure_aluminum -> cost = 17.99;
        $materialFromDB = Material::where('material_name', '=', $pure_aluminum->material_name)->first();
        if ($materialFromDB == null)
            $pure_aluminum->save();

        $aluminum_alloy = new Material();
        $aluminum_alloy -> material_name = 'Aluminum Alloy';
        $aluminum_alloy -> material_quantity_in_stock = 1;
        $aluminum_alloy -> cost = 14.99;
        $materialFromDB = Material::where('material_name', '=', $aluminum_alloy->material_name)->first();
        if ($materialFromDB == null)
            $aluminum_alloy->save();

        $rubber = new Material();
        $rubber -> material_name = 'Rubber';
        $rubber -> material_quantity_in_stock = 1;
        $rubber -> cost = 4.99;
        $materialFromDB = Material::where('material_name', '=', $rubber->material_name)->first();
        if ($materialFromDB == null)
            $rubber->save();

        $nylon = new Material();
        $nylon -> material_name = 'Nylon';
        $nylon -> material_quantity_in_stock = 1;
        $nylon -> cost = 3.99;
        $materialFromDB = Material::where('material_name', '=', $nylon->material_name)->first();
        if ($materialFromDB == null)
            $nylon->save();

        $spandex = new Material();
        $spandex -> material_name = 'Spandex';
        $spandex -> material_quantity_in_stock = 1;
        $spandex -> cost = 2.99;
        $materialFromDB = Material::where('material_name', '=', $spandex->material_name)->first();
        if ($materialFromDB == null)
            $spandex->save();

        $leather = new Material();
        $leather -> material_name = 'Leather';
        $leather -> material_quantity_in_stock = 1;
        $leather -> cost = 9.99;
        $materialFromDB = Material::where('material_name', '=', $leather->material_name)->first();
        if ($materialFromDB == null)
            $leather->save();

        $polycarbonate = new Material();
        $polycarbonate -> material_name = 'Polycarbonate';
        $polycarbonate -> material_quantity_in_stock = 1;
        $polycarbonate -> cost = 2.99;
        $materialFromDB = Material::where('material_name', '=', $polycarbonate->material_name)->first();
        if ($materialFromDB == null)
            $polycarbonate->save();



        //PARTS SEEDS==============================================================
        $carbon_fiber_fork = new Part();
        $carbon_fiber_fork->part_name = 'Carbon Fiber Fork';
        $carbon_fiber_fork->part_quantity_in_stock = '1';
        $carbon_fiber_fork->category = 'Fork';
        $partFromDB = Part::where('part_name', '=', $carbon_fiber_fork->part_name)->first();
        if ($partFromDB == null)
            $carbon_fiber_fork->save();
        $carbon_fiber_fork->materials()->save($carbon_fiber);
        $carbon_fiber_fork->materials()->save($pure_aluminum);

        $titanium_fork = new Part();
        $titanium_fork->part_name = 'Titanium Fork';
        $titanium_fork->part_quantity_in_stock = '1';
        $titanium_fork->category = 'Fork';
        $partFromDB = Part::where('part_name', '=', $titanium_fork->part_name)->first();
        if ($partFromDB == null)
            $titanium_fork->save();
        $titanium_fork->materials()->save($titanium);
        $titanium_fork->materials()->save($pure_aluminum);

        $magnesium_fork = new Part();
        $magnesium_fork->part_name = 'Magnesium Fork';
        $magnesium_fork->part_quantity_in_stock = '1';
        $magnesium_fork->category = 'Fork';
        $partFromDB = Part::where('part_name', '=', $magnesium_fork->part_name)->first();
        if ($partFromDB == null)
            $magnesium_fork->save();
        $magnesium_fork->materials()->save($magnesium);
        $magnesium_fork->materials()->save($pure_aluminum);

        $threaded_headset = new Part();
        $threaded_headset->part_name = 'Threaded Headset';
        $threaded_headset->category = 'Headset';
        $threaded_headset->part_quantity_in_stock = '1';
        $partFromDB = Part::where('part_name', '=', $threaded_headset->part_name)->first();
        if ($partFromDB == null)
            $threaded_headset->save();
        $threaded_headset->materials()->save($stainless_steel);
        $threaded_headset->materials()->save($polycarbonate);
        $threaded_headset->materials()->save($rubber);

        $seatpost = new Part();
        $seatpost->part_name = 'Seatpost';
        $seatpost->category = 'Seatpost';
        $seatpost->part_quantity_in_stock = '1';
        $partFromDB = Part::where('part_name', '=', $seatpost->part_name)->first();
        if ($partFromDB == null)
            $seatpost->save();
        $seatpost->materials()->save($stainless_steel);

        $threadless_headset = new Part();
        $threadless_headset->part_name = 'Threadless Headset';
        $threadless_headset->part_quantity_in_stock = '1';
        $threadless_headset->category = 'Headset';
        $partFromDB = Part::where('part_name', '=', $threadless_headset->part_name)->first();
        if ($partFromDB == null)
            $threadless_headset->save();
        $threadless_headset->materials()->save($stainless_steel);
        $threadless_headset->materials()->save($polycarbonate);
        $threadless_headset->materials()->save($rubber);


        $aluminum_crankset = new Part();
        $aluminum_crankset->part_name = 'Aluminum Crankset';
        $aluminum_crankset->part_quantity_in_stock = '1';
        $aluminum_crankset->category = 'Crankset';
        $partFromDB = Part::where('part_name', '=', $aluminum_crankset->part_name)->first();
        if ($partFromDB == null)
            $aluminum_crankset->save();
        $aluminum_crankset->materials()->save($aluminum_alloy);
        $aluminum_crankset->materials()->save($stainless_steel);

        $titanium_crankset = new Part();
        $titanium_crankset->part_name = 'Titanium Crankset';
        $titanium_crankset->part_quantity_in_stock = '1';
        $titanium_crankset->category = 'Crankset';
        $partFromDB = Part::where('part_name', '=', $titanium_crankset->part_name)->first();
        if ($partFromDB == null)
            $titanium_crankset->save();
        $titanium_crankset->materials()->save($titanium);
        $titanium_crankset->materials()->save($stainless_steel);

        $plastic_pedals = new Part();
        $plastic_pedals->part_name = 'Plastic Pedals (pair)';
        $plastic_pedals->part_quantity_in_stock = '1';
        $plastic_pedals->category = 'Pedals';
        $partFromDB = Part::where('part_name', '=', $plastic_pedals->part_name)->first();
        if ($partFromDB == null)
            $plastic_pedals->save();
        $plastic_pedals->materials()->save($polycarbonate);

        $metal_pedals = new Part();
        $metal_pedals->part_name = 'Metal Pedals (pair)';
        $metal_pedals->part_quantity_in_stock = '1';
        $metal_pedals->category = 'Pedals';
        $partFromDB = Part::where('part_name', '=', $metal_pedals->part_name)->first();
        if ($partFromDB == null)
            $metal_pedals->save();
        $metal_pedals->materials()->save($stainless_steel);
        
        $standard_handlebar = new Part();
        $standard_handlebar->part_name = 'Standard Handlebar';
        $standard_handlebar->part_quantity_in_stock = '1';
        $standard_handlebar->category = 'Handlebar';
        $partFromDB = Part::where('part_name', '=', $standard_handlebar->part_name)->first();
        if ($partFromDB == null)
            $standard_handlebar->save();
        $standard_handlebar->materials()->save($aluminum_alloy);
        $standard_handlebar->materials()->save($rubber);

        $stem = new Part();
        $stem->part_name = 'Stem';
        $stem->part_quantity_in_stock = '1';
        $stem->category = 'Stem';
        $partFromDB = Part::where('part_name', '=', $stem->part_name)->first();
        if ($partFromDB == null)
            $stem->save();
        $stem->materials()->save($aluminum_alloy);

        $plastic_saddle = new Part();
        $plastic_saddle->part_name = 'Plastic Saddle';
        $plastic_saddle->part_quantity_in_stock = '1';
        $plastic_saddle->category = 'Saddle';
        $partFromDB = Part::where('part_name', '=', $plastic_saddle->part_name)->first();
        if ($partFromDB == null)
            $plastic_saddle->save();
        $plastic_saddle->materials()->save($nylon);
        $plastic_saddle->materials()->save($spandex);
        $plastic_saddle->materials()->save($titanium);

        $carbon_fiber_saddle = new Part();
        $carbon_fiber_saddle->part_name = 'Carbon Fiber Saddle';
        $carbon_fiber_saddle->part_quantity_in_stock = '1';
        $carbon_fiber_saddle->category = 'Saddle';
        $partFromDB = Part::where('part_name', '=', $carbon_fiber_saddle->part_name)->first();
        if ($partFromDB == null)
            $carbon_fiber_saddle->save();
        $carbon_fiber_saddle->materials()->save($carbon_fiber);
        $carbon_fiber_saddle->materials()->save($leather);
        $carbon_fiber_saddle->materials()->save($titanium);

        $rim_brake_assembly = new Part();
        $rim_brake_assembly->part_name = 'Rim Brake Assembly';
        $rim_brake_assembly->part_quantity_in_stock = '1';
        $rim_brake_assembly->category = 'Brakes';
        $partFromDB = Part::where('part_name', '=', $rim_brake_assembly->part_name)->first();
        if ($partFromDB == null)
            $rim_brake_assembly->save();
        $rim_brake_assembly->materials()->save($stainless_steel);
        $rim_brake_assembly->materials()->save($polycarbonate);
        $rim_brake_assembly->materials()->save($aluminum_alloy);

        $disk_brake_assembly = new Part();
        $disk_brake_assembly->part_name = 'Disk Brake Assembly';
        $disk_brake_assembly->part_quantity_in_stock = '1';
        $disk_brake_assembly->category = 'Brakes';
        $partFromDB = Part::where('part_name', '=', $disk_brake_assembly->part_name)->first();
        if ($partFromDB == null)
            $disk_brake_assembly->save();
        $disk_brake_assembly->materials()->save($rubber);
        $disk_brake_assembly->materials()->save($stainless_steel);
        $disk_brake_assembly->materials()->save($polycarbonate);
        $disk_brake_assembly->materials()->save($aluminum_alloy);

        $shock = new Part();
        $shock->part_name = 'Shock';
        $shock->part_quantity_in_stock = '1';
        $shock->category = 'Shock';
        $partFromDB = Part::where('part_name', '=', $shock->part_name)->first();
        if ($partFromDB == null)
            $shock->save();
        $shock->materials()->save($stainless_steel);


        $rim = new Part();
        $rim->part_name = 'Rim';
        $rim->part_quantity_in_stock = '1';
        $rim->category = 'Rim';
        $partFromDB = Part::where('part_name', '=', $rim->part_name)->first();
        if ($partFromDB == null)
            $rim->save();
        $rim->materials()->save($aluminum_alloy);


        $tire = new Part();
        $tire->part_name = 'Tire';
        $tire->part_quantity_in_stock = '1';
        $tire->category = 'Tire';
        $partFromDB = Part::where('part_name', '=', $tire->part_name)->first();
        if ($partFromDB == null)
            $tire->save();
        $tire->materials()->save($rubber);



        //BICYCLES SEEDS =======================================
        $bike1 = new Bike();
        $bike1 -> type = 'Mountain Bike';
        $bike1 -> size = '18';
        $bike1 -> color = 'Red';
        $bike1 -> finish = 'Metallic';
        $bike1 -> grade = 'B';
        $bike1 -> price = 299.95;
        $bike1 -> quantity_in_stock = 1;
        $bike1->save();
        $bike1->parts()->save($titanium_fork);
        $bike1->parts()->save($seatpost);
        $bike1->parts()->save($threadless_headset);
        $bike1->parts()->save($titanium_crankset);
        $bike1->parts()->save($plastic_pedals);
        $bike1->parts()->save($standard_handlebar);
        $bike1->parts()->save($stem);
        $bike1->parts()->save($plastic_saddle);
        $bike1->parts()->save($rim_brake_assembly);
        $bike1->parts()->save($shock);
        $bike1->parts()->save($rim);
        $bike1->parts()->save($tire);

        $bike2 = new Bike();
        $bike2 -> type = 'Road Bike';
        $bike2 -> size = '18';
        $bike2 -> color = 'Red';
        $bike2 -> finish = 'Pearlescent';
        $bike2 -> grade = 'C';
        $bike2 -> price = 219.95;
        $bike2 -> quantity_in_stock = 1;
        $bike2->save();
        $bike2->parts()->save($titanium_fork);
        $bike2->parts()->save($seatpost);
        $bike2->parts()->save($threaded_headset);
        $bike2->parts()->save($aluminum_crankset);
        $bike2->parts()->save($plastic_pedals);
        $bike2->parts()->save($standard_handlebar);
        $bike2->parts()->save($stem);
        $bike2->parts()->save($plastic_saddle);
        $bike2->parts()->save($rim_brake_assembly);
        $bike2->parts()->save($shock);
        $bike2->parts()->save($rim);
        $bike2->parts()->save($tire);



        $bike3 = new Bike();
        $bike3 -> type = 'Track Bike';
        $bike3 -> size = '18';
        $bike3 -> color = 'Red';
        $bike3 -> finish = 'Matte';
        $bike3 -> grade = 'A';
        $bike3 -> price = 999.95;
        $bike3 -> quantity_in_stock = 1;
        $bike3->save();
        $bike3->parts()->save($carbon_fiber_fork);
        $bike3->parts()->save($seatpost);
        $bike3->parts()->save($threadless_headset);
        $bike3->parts()->save($titanium_crankset);
        $bike3->parts()->save($metal_pedals);
        $bike3->parts()->save($standard_handlebar);
        $bike3->parts()->save($stem);
        $bike3->parts()->save($carbon_fiber_saddle);
        $bike3->parts()->save($disk_brake_assembly);
        $bike3->parts()->save($shock);
        $bike3->parts()->save($rim);
        $bike3->parts()->save($tire);


        //ORDER SEEDS =======================================
        $order1 = new Order();
        $order1 -> ETA = '2021-06-21';
        $order1 -> status = 'In Transit';
        $order1->save();
        $order1->materials()->save($aluminum_alloy, ['order_quantity' => 100]);
        $order1->materials()->save($carbon_fiber, ['order_quantity' => 150]);
        $order1->materials()->save($stainless_steel, ['order_quantity' => 95]);

        $order2 = new Order();
        $order2 -> ETA = '2021-09-19';
        $order2 -> status = 'In Transit';
        $order2->save();
        $order2->materials()->save($rubber, ['order_quantity' => 50]);
        $order2->materials()->save($titanium, ['order_quantity' => 125]);
        $order2->materials()->save($stainless_steel, ['order_quantity' => 200]);

        $order3 = new Order();
        $order3 -> ETA = '2021-08-13';
        $order3 -> status = 'In Transit';
        $order3->save();
        $order3->materials()->save($carbon_fiber, ['order_quantity' => 50]);
        $order3->materials()->save($magnesium, ['order_quantity' => 10]);
        $order3->materials()->save($nylon, ['order_quantity' => 20]);

        $order4 = new Order();
        $order4 -> ETA = '2021-10-04';
        $order4 -> status = 'In Transit';
        $order4->save();
        $order4->materials()->save($spandex, ['order_quantity' => 70]);
        $order4->materials()->save($leather, ['order_quantity' => 100]);
        $order4->materials()->save($aluminum_alloy, ['order_quantity' => 50]);

        //SALE SEEDS =======================================
        $sale1 = new Sale();
        $sale1->profit = 1499.75;
        $sale1->save();
        $sale1->bikes()->save($bike1, ['quantity_sold' => 5]);

        $sale2 = new Sale();
        $sale2->profit = 2999.5;
        $sale2->save();
        $sale2->bikes()->save($bike1, ['quantity_sold' => 10]);

        $sale3 = new Sale();
        $sale3->profit = 1759.6;
        $sale3->save();
        $sale3->bikes()->save($bike2, ['quantity_sold' => 8]);

        $sale4 = new Sale();
        $sale4->profit = 11999.4;
        $sale4->save();
        $sale4->bikes()->save($bike3, ['quantity_sold' => 12]);
    }
}
