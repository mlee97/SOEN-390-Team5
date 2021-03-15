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

        $seatMachine = new Machine();
        $seatMachine -> name = 'Seat Machine';
        $seatMachine -> status = 'offline';

        $frameMachine = new Machine();
        $frameMachine -> name = 'Frame Machine';
        $frameMachine -> status = 'offline';

        $wheelMachine = new Machine();
        $wheelMachine -> name = 'Wheel Machine';
        $wheelMachine -> status = 'offline';

        $pedalMachine = new Machine();
        $pedalMachine -> name = 'Pedal Machine';
        $pedalMachine -> status = 'offline';

        $handleMachine = new Machine();
        $handleMachine -> name = 'Handle Machine';
        $handleMachine -> status = 'offline';

        $assemblerMachine = new Machine();
        $assemblerMachine -> name = 'Assembler Machine';
        $assemblerMachine -> status = 'offline';

        $seatMachine->save();
        $frameMachine->save();
        $wheelMachine->save();
        $pedalMachine->save();
        $handleMachine->save();
        $assemblerMachine->save();
        
    }
}
