<?php

namespace App\Http\Controllers;


use App\Http\Requests\Auth\LoginRequest;
use App\Models\Order;
use App\Models\Log;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    
    /**
    * Returns the shipping view after clicking on the Shipping button or after modifying a table on the Shipping page.
    *
    * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request
    * @return view      the shipping view and the updated values of each row of the orders.
    */
    public function goToShipping(Request $request)
    {
        //Store the data from the Bikes, Parts, and Materials tables into variables
        $orders = Order::all();

        //Log the results of the get request
        $msg_str = 'Shipping page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);

        //Return the inventory page and an array of arrays containing the data from the bikes, parts, and materials tables.
        return view('shipping', ['orders' => $orders]);
    }

}
