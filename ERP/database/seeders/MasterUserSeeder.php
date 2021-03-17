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
        $masterUser -> first_name = 'IT';
        $masterUser -> last_name = 'Admin';
        $masterUser -> email = 'admin@gmail.com';
        $masterUser -> password = Hash::make('password');
        $masterUser -> user_type = 0;

        $user = User::where('email', '=', $masterUser->email)->first();

        if($user == null)
            $masterUser->save();

        $hrUser = new User();
        $hrUser -> first_name = 'Human';
        $hrUser -> last_name = 'Resources';
        $hrUser -> email = 'hr@gmail.com';
        $hrUser -> password = Hash::make('password');
        $hrUser -> user_type = 1;

        $floorUser = new User();
        $floorUser -> first_name = 'Floor';
        $floorUser -> last_name = 'Worker';
        $floorUser -> email = 'floor@gmail.com';
        $floorUser -> password = Hash::make('password');
        $floorUser -> user_type = 2;

        $shippingUser = new User();
        $shippingUser -> first_name = 'Shipping';
        $shippingUser -> last_name = 'Department';
        $shippingUser -> email = 'shipping@gmail.com';
        $shippingUser -> password = Hash::make('password');
        $shippingUser -> user_type = 3;

        $inventoryUser = new User();
        $inventoryUser -> first_name = 'Inventory';
        $inventoryUser -> last_name = 'Manager';
        $inventoryUser -> email = 'inventory@gmail.com';
        $inventoryUser -> password = Hash::make('password');
        $inventoryUser -> user_type = 4;

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

    }
}
