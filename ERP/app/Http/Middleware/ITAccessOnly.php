<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ITAccessOnly
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
        if(Auth::user()-> user_type != 0) {
            $msg_str = 'Unauthorized Access: Attempt to access IT-Restricted Page. User redirected';
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'WARNING',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);
            return redirect('/'); //redirects user to main page if they are not IT personal
        }
        else {
            return $next($request); //allows request to proceed as usual
        }
    }
}
