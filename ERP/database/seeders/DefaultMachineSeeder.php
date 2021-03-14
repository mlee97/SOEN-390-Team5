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

        $seatMachine = new Machine();
        $seatMachine -> name = 'Seat Machine';
        $seatMachine -> status = 'offline';

        $frameMachine = new Machine();
        $frameMachine -> name = 'Frame Machine';
        $frameMachine -> status = 'offline';

        $wheelMachine = new Machine();
        $wheelMachine -> name = 'Wheel Machine';
        $wheelMachine -> status = 'offline';

        $gearMachine = new Machine();
        $gearMachine -> name = 'Gear Machine';
        $gearMachine -> status = 'offline';

        $defaultMachine->save();
        $seatMachine->save();
        $frameMachine->save();
        $wheelMachine->save();
        $gearMachine->save();
    }
}
