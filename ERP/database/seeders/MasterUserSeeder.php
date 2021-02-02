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

    }
}
