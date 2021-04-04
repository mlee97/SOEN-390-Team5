<?php

namespace App\Http\Controllers;


use App\Models\Sale;
use App\Models\Bike;
use Exception;
use Request;

/**
 *  Takes care of the logics in the accountant view.
 */
class AccountantController extends Controller
{
    // Redirects to the accountant view.
    public function goToAccoutantView()
    {
        $sales = Sale::all(); // Getting all data from Sale.    
        $totalSalesProfit = collect($sales)->sum('profit'); // Sums all values in the 'profit' colomn in the sales table.

        $currentMonth = now()->month;
        $currentYear = now()->year;

        return view('accountant', ['sales' => $sales, 'totalSalesProfit' => $totalSalesProfit, 'currentMonth' => $currentMonth, 'currentYear' => $currentYear]);
    }
        $bicycles = Bike::all();
    
    }


    //for saving sale order
    public function saveSaleOrder()
    {
        //getting all inputs from the request
        $body = Request::all();

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

        return $this->sales();
}
