<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
            'user_type' => 'required'
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.management')
            ->with('success_msg', 'User has been successfully created!'); //Send a temporary success message. This is saved in the session;
    }

    public function goToCreateUser()
    {
        return view('User.create-user');
    }

    public function goToUserManagement()
    {
        $users = User::all();
        return view('User.user-management', ['users' => $users]);
    }

    public function goToInventory()
    {
        return view('inventory');
    }

    public function logoutUser(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function goToLogin()
    {
        return view('User.login');
    }

    public function loginUser(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect(RouteServiceProvider::HOME);
    }

    public function updateUser(Request $request){

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'user_type' => 'required'
        ]);

        $user = User::find($request->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;

        $user->save();

        return redirect()->route('user.management')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
    }

}
