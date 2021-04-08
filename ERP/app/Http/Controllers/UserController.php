<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Mail\LowMaterialWarning;
use App\Models\Log;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        //Backend Validation; This validate and return user to page if errors are found

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'user_type' => 'required'
        ]);

        if ($validator->fails()) {
            $msg_str = 'New user creation failed for email: ';
            $msg_str .= $request->input('email');

            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            return redirect()->route('create.user')
                ->withErrors($validator)
                ->withInput();
        } else {

            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'user_type' => $request->user_type,
                'password' => Hash::make($request->password),
            ]);

            $msg_str = 'New user created successfully with email: ';
            $msg_str .= $request->input('email');

            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'INFO',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            return redirect()->route('user.management')
                ->with('success_msg', 'User has been successfully created!'); //Send a temporary success message. This is saved in the session;

        }

    }

    public function goToCreateUser(Request $request)
    {
        $msg_str = 'User creation page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);
        return view('User.create-user');
    }

    public function goToUserManagement(Request $request)
    {
        $msg_str = 'User Management page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);
        $users = User::all();
        return view('User.user-management', ['users' => $users]);
    }

    public function goToInventory()
    {
        return view('inventory');
    }

    public function logoutUser(Request $request)
    {
        $msg_str = 'User has logged out of the ERP System';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

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
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $msg_str = 'User successfully logged in';
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'INFO',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            $user = User::find(Auth::user()->id);
            //If the person who logged on is an Inventory Manager, then they will get an email with a low material report.
            if (Auth::user()->user_type == 4) {
                $materialWithLowStock = DB::table('materials')
                    ->where('material_quantity_in_stock', '<=', 10)
                    ->get();

                if ($materialWithLowStock->count() > 0) {
                    Mail::to($user->email)->send(new LowMaterialWarning($materialWithLowStock, $user));
                }
            }

            return redirect(RouteServiceProvider::HOME);
        }

        $msg_str = 'Failed Log in attempt with email: ';
        $msg_str .= $request->input('email');
        Log::create([
            'ip_address' => $request->ip(),
            'log_type' => 'ERROR',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Updating a user's details.
     */
    public function updateUser(Request $request)
    {

        // Validates received data are correct.
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|',
            'user_type' => 'required'
        ]);

        if ($validator->fails()) {
            $msg_str = 'Updating user failed due to validation for user:  ';
            $msg_str .= $request->input('email');

            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            return redirect()->route('create.user')
                ->withErrors($validator)
                ->withInput();
        } else {
            $msg_str = 'Updating user was successful for: ';
            $msg_str .= $request->input('email');

            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'INFO',
                'request_type' => 'POST',
                'message' => $msg_str,
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

}
