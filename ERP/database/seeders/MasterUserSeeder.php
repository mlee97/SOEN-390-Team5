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

        $accountant = new User();
        $accountant -> first_name = 'Tony';
        $accountant -> last_name = 'Montana';
        $accountant -> email = 'accountant@gmail.com';
        $accountant -> password = Hash::make('password');
        $accountant -> user_type = 6;

        $productManager = new User();
        $productManager -> first_name = 'Nissan';
        $productManager -> last_name = 'Sentra';
        $productManager -> email = 'productmanager@gmail.com';
        $productManager -> password = Hash::make('password');
        $productManager -> user_type = 7;

        $salesPerson = new User();
        $salesPerson -> first_name = 'Jonathan';
        $salesPerson -> last_name = 'Humpleton';
        $salesPerson -> email = 'sales@gmail.com';
        $salesPerson -> password = Hash::make('password');
        $salesPerson -> user_type = 8;

        $qualityPerson = new User();
        $qualityPerson -> first_name = 'Sale';
        $qualityPerson -> last_name = 'Person';
        $qualityPerson -> email = 'quality@gmail.com';
        $qualityPerson -> password = Hash::make('password');
        $qualityPerson -> user_type = 9;


        //The code below verifies that the users we are adding to the database as a seed does not already exist in the database.
        //If the entry already exists, then it will not be added to the DB as it will throw an error if we do

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

        if($user8 == null)
            $manufacturerWorker3->save();

        $user9 = User::where('email', '=', $productManager->email)->first();

        if($user9 == null)
            $productManager->save();
        
        $user10 = User::where('email', '=', $accountant->email)->first();
        
        if($user10 == null)
            $accountant->save();
            
        $user11 = User::where('email', '=', $salesPerson->email)->first();
    
        if($user11 == null)
            $salesPerson->save();

        $user12 = User::where('email', '=', $qualityPerson->email)->first();

        if($user12 == null)
                $qualityPerson->save();
    }
}
