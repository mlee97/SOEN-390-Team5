<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MasterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masterUser = new User();
        $masterUser -> first_name = 'Jimmy';
        $masterUser -> last_name = 'Neutron';
        $masterUser -> email = 'admin@gmail.com';
        $masterUser -> password = Hash::make('password');
        $masterUser -> user_type = 0;

        $user = User::where('email', '=', $masterUser->email)->first();

        if($user == null)
            $masterUser->save();

        $hrUser = new User();
        $hrUser -> first_name = 'Joe';
        $hrUser -> last_name = 'Bobberson';
        $hrUser -> email = 'hr@gmail.com';
        $hrUser -> password = Hash::make('password');
        $hrUser -> user_type = 1;

        $floorUser = new User();
        $floorUser -> first_name = 'Nikkie';
        $floorUser -> last_name = 'Minaj';
        $floorUser -> email = 'floor@gmail.com';
        $floorUser -> password = Hash::make('password');
        $floorUser -> user_type = 2;

        $shippingUser = new User();
        $shippingUser -> first_name = 'Contigo';
        $shippingUser -> last_name = 'Las Vegas';
        $shippingUser -> email = 'shipping@gmail.com';
        $shippingUser -> password = Hash::make('password');
        $shippingUser -> user_type = 3;

        $inventoryUser = new User();
        $inventoryUser -> first_name = 'Guy';
        $inventoryUser -> last_name = 'Fieri';
        $inventoryUser -> email = 'inventory@gmail.com';
        $inventoryUser -> password = Hash::make('password');
        $inventoryUser -> user_type = 4;

        $manufacturerWorker = new User();
        $manufacturerWorker -> first_name = 'Git';
        $manufacturerWorker -> last_name = 'Man';
        $manufacturerWorker -> email = 'gman@gmail.com';
        $manufacturerWorker -> password = Hash::make('password');
        $manufacturerWorker -> user_type = 5;

        $manufacturerWorker2 = new User();
        $manufacturerWorker2 -> first_name = 'Robert';
        $manufacturerWorker2 -> last_name = 'Kardashian';
        $manufacturerWorker2 -> email = 'rk@gmail.com';
        $manufacturerWorker2 -> password = Hash::make('password');
        $manufacturerWorker2 -> user_type = 5;

        $manufacturerWorker3 = new User();
        $manufacturerWorker3 -> first_name = 'Lil';
        $manufacturerWorker3 -> last_name = 'Uzi';
        $manufacturerWorker3 -> email = 'uzi@gmail.com';
        $manufacturerWorker3 -> password = Hash::make('password');
        $manufacturerWorker3 -> user_type = 5;

        $user2 = User::where('email', '=', $hrUser->email)->first();

        if($user2 == null)
            $hrUser->save();

        $user3 = User::where('email', '=', $floorUser->email)->first();

        if($user3 == null)
            $floorUser->save();

        $user4 = User::where('email', '=', $shippingUser->email)->first();

        if($user4 == null)
            $shippingUser->save();

        $user5 = User::where('email', '=', $inventoryUser->email)->first();

        if($user5 == null)
            $inventoryUser->save();


        $user6 = User::where('email', '=', $manufacturerWorker->email)->first();

        if($user6 == null)
            $manufacturerWorker->save();


        $user7 = User::where('email', '=', $manufacturerWorker2->email)->first();

        if($user7 == null)
            $manufacturerWorker2->save();

        $user8 = User::where('email', '=', $manufacturerWorker3->email)->first();

        if($user8== null)
            $manufacturerWorker3->save();

    }
}
