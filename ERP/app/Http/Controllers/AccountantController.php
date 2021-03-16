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

        return view('accountant', ['sales' => $sales]);
    }
}
