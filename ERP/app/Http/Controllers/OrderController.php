<?php

namespace App\Http\Controllers;


use App\Models\Material;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $todays_date = Carbon::now();
        $rand_deliver_date = $todays_date->addDays(rand(1,5));

        $status_array = array('Submitted', 'In Transit', "Delivered");
        $status = $status_array[array_rand($status_array, 1)];


        $newOrder = Order::create([
            'status' => $status,
            'ETA' => $rand_deliver_date
        ]);

        $count = 1;
        do {
            $mat_key = 'MAT' . $count;
            $odr_qty_key = 'ODR_QTY' . $count;
            $mat = Material::find($request->get($mat_key));
            $odr_qty = $request->get($odr_qty_key);

            $newOrder->materials()->save($mat, ['order_quantity' => $odr_qty]);

            $count++;
        } while ($request->has('MAT' . $count));

        return redirect('/inventory');
    }
}
