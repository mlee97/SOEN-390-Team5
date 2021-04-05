<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Bike;

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
    
}
