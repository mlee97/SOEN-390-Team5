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

        $seatMachine1 = new Machine();
        $seatMachine1 -> name = 'Seat Machine 1';
        $seatMachine1 -> status = 'offline';

        $seatMachine2 = new Machine();
        $seatMachine2 -> name = 'Seat Machine 2';
        $seatMachine2 -> status = 'offline';

        $frameMachine1 = new Machine();
        $frameMachine1 -> name = 'Frame Machine 1';
        $frameMachine1 -> status = 'offline';

        $frameMachine2 = new Machine();
        $frameMachine2 -> name = 'Frame Machine 2';
        $frameMachine2 -> status = 'offline';

        $wheelMachine1 = new Machine();
        $wheelMachine1 -> name = 'Wheel Machine 1';
        $wheelMachine1 -> status = 'offline';

        $wheelMachine2 = new Machine();
        $wheelMachine2 -> name = 'Wheel Machine 2';
        $wheelMachine2 -> status = 'offline';

        $pedalMachine1 = new Machine();
        $pedalMachine1 -> name = 'Pedal Machine 1';
        $pedalMachine1 -> status = 'offline';
         
        $pedalMachine2 = new Machine();
        $pedalMachine2 -> name = 'Pedal Machine 2';
        $pedalMachine2 -> status = 'offline';

        $handleMachine1 = new Machine();
        $handleMachine1 -> name = 'Handle Machine 1';
        $handleMachine1 -> status = 'offline';

        $handleMachine2 = new Machine();
        $handleMachine2 -> name = 'Handle Machine 2';
        $handleMachine2 -> status = 'offline';

        $assemblerMachine1 = new Machine();
        $assemblerMachine1 -> name = 'Assembler Machine 1';
        $assemblerMachine1 -> status = 'offline';

        $assemblerMachine2 = new Machine();
        $assemblerMachine2 -> name = 'Assembler Machine 2';
        $assemblerMachine2 -> status = 'offline';

        $seatMachine1->save();
        $seatMachine2->save();
        $frameMachine1->save();
        $frameMachine2->save();
        $wheelMachine1->save();
        $wheelMachine2->save();
        $pedalMachine1->save();
        $pedalMachine2->save();
        $handleMachine1->save();
        $handleMachine2->save();
        $assemblerMachine1->save();
        $assemblerMachine2->save();
        
    }
}
