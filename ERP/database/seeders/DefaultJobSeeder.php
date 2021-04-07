<?php

namespace Database\Seeders;

use App\Models\Bike;
use App\Models\Job;
use Illuminate\Database\Seeder;

class DefaultJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create seed jobs for each bike currently in the database.
        //Since all seeds are run at the same time, the list of bikes defined in the Bike_parts_Material_Order_Sale_Seeder
        //will be used for this purpose.
        $bikes = Bike::all();

        foreach($bikes as $bike) {
            $defaultJob = new Job();
            $defaultJob->status = 'Queued';
            $defaultJob->quantity = rand(1, 25);
            $defaultJob->quality = 'Not Inspected';
            $defaultJob->bike_id = $bike->id;
            $defaultJob->save();
        }
    }
}
