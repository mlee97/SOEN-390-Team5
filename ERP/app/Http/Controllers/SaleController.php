<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{    
    // Redirects to the sales view.
    public function goToSalesView()
    {
        $sales = Sale::all(); // Getting all data from Sale.    
        $bicycles = Bike::all();
        
        return view('sales', ['sales' => $sales, 'bicycles' => $bicycles]);
    }

    //for saving sale order
    public function saveSaleOrder(Request $request)
    {
        //getting all inputs from the request
        $body = $request->all();

        //creating a new sale
        $sale = new Sale();
        //getting profit value from the request body and setting it into the sale model
        $sale->profit = $body["profit"];

        //try to save sale and if it's okay, try to add a new record to bike_sale
        if ($sale->save()) {
            $bike_sale_pivot = [
                "bike_id" => $body["bicycleId"], "sale_id" => $sale->id,
                'quantity_sold' => $body["quantitySold"]
            ];
            $sale->bikes()->sync([1 => $bike_sale_pivot]);
        }

        return $this->goToSalesView();
    }
}
