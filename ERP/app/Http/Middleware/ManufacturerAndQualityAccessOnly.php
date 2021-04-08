<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManufacturerAndQualityAccessOnly
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
        if(Auth::user()-> user_type != 5 && Auth::user()-> user_type != 9)
            return redirect('/'); //redirects user to main page if they are not manufacturing personnel
        else {
            return $next($request); //allows request to proceed as usual
        }
    }
}
