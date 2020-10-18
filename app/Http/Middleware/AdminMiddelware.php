<?php

namespace App\Http\Middleware;

use App\Models\Log;
use App\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;


class AdminMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::User() == true && Auth::User()->statues == 1) {



            return $next($request);
        } else {

            if (Auth::User()->statues == 1) {
                Auth::logout();
                return redirect('/login')->with('message_fales', 'call support');
            } else {
                Auth::logout();
                return redirect('/sign_up')->with('message_fales', 'call support');
            }

        }
    }
}
