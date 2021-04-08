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
        //Store the data from the order table into the $order variable/
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

        //Return the shipping page and an array of arrays containing the data from the order table.
        return view('shipping', ['orders' => $orders]);
    }

    /**
    * Toggles the status of a specific order.
    *
    * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
    * @param  $id       the order id of the order in which the status should be updated.
    * @return view      the shipping view.
    */
    public function markReceived(Request $request) {

        //Find the particular row in the Order table that we want to update
        $order = Order::find($request->orderID);


        //Update material quantities
        foreach($order->materials as $mat){
            $mat->material_quantity_in_stock = $mat->material_quantity_in_stock + $mat->material_order_pivot->order_quantity;
            $mat->save();
        }
        
        //Apply the status changes depending on the current status of the order.
        $order->status = "Received";

        //Save the changes.
        $order->save();

        //Log the results
        $msg_str = 'Order status with ID '. $order->id. ' updated successfully';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);
        
        //Return the shipping page with success message.
        return redirect()->route('shipping')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
     }

}
