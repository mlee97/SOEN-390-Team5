<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Seeder;

class DefaultMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultMachine = new Machine();
        $defaultMachine -> name = 'machine';
        $defaultMachine -> status = 'offline';



        $defaultMachine->save();
      
    }
}
