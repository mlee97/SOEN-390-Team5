<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        //Backend Validation; This validate and return user to page if errors are found
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'user_type'=> 'required'
        ]);

        Auth::login($user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
        ]));

        //redirect user to home page
        return redirect()->route('home');
    }

    public function createUserPage(){
        return view('User.create-user');
    }

    public function getAllUsers() {
        $users = User::all();
        return view('User.user-management', ['users' => $users]);
    }
}
