<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use Closure;

class Auth
{

    public function handle($request, Closure $next)
    {

        if (Session::get('login')) {
            return $next($request);            
        }else{
            abort(403,'Access Denied');
        }

    }

}
