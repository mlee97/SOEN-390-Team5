<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//product manager also has access to the inventory page
class InventoryAccessOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()-> user_type != 4 && Auth::user()-> user_type != 7 )
            return redirect('/'); //redirects user to main page if they are not inventory personnel
        else {
            return $next($request); //allows request to proceed as usual
        }
    }
}
