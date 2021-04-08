<?php

namespace App\Http\Controllers;


use App\Mail\MaterialOrderConfirmation;
use App\Models\Material;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //creates order in the orders table
    public function createOrder(Request $request)
    {
        $todays_date = Carbon::now();
        $rand_deliver_date = $todays_date->addDays(rand(1,5));

        $status_array = array('Submitted', 'In Transit');
        $status = $status_array[array_rand($status_array, 1)];


        //creates orders with random data (above)
        $newOrder = Order::create([
            'status' => $status,
            'ETA' => $rand_deliver_date
        ]);

        //for every material ordered, link it to $newOrder
        $count = 1;
        $totalCost = 0.0;
        do {
            $mat_key = 'MAT' . $count;
            $odr_qty_key = 'ODR_QTY' . $count;
            $mat = Material::find($request->get($mat_key));
            $odr_qty = $request->get($odr_qty_key);

            $newOrder->materials()->save($mat, ['order_quantity' => $odr_qty]);

            $totalCost = $totalCost + ($mat->cost * $odr_qty);
            $count++;
        } while ($request->has('MAT' . $count));


        //Send email to all accountants that an order has been placed with order details
        $accountantUsers = DB::table('users')->where('user_type', '=', 6)->get();
        foreach ($accountantUsers as $aUser) {
            Mail::to($aUser->email)->send(new MaterialOrderConfirmation($newOrder, $totalCost, new User( (array)$aUser)));
        }

        $msg_str = 'Order with ID '. $newOrder->id . ' has been successfully created';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return redirect('/inventory');
    }
}
