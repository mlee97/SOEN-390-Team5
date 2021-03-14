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
        $defaultMachine -> name = 'Default_machine';
        $defaultMachine -> status = 'offline';

        $defaultMachine->save();
    }
}
