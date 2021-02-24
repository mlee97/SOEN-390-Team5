<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()-> user_type == 1 || Auth::user()-> user_type == 2 || Auth::user()-> user_type == 3)
            return redirect('/'); //redirects user to main page if they are not IT personal or inventory personnel
        else {
            return $next($request); //allows request to proceed as usual
        }
    }
}
