<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 *  Takes care of the logics in the accountant view.
 */
class AccountantController extends Controller
{
    // Redirects to the accountant view.
    public function goToAccoutantView()
    {
        return view('accountant');
    }
}
