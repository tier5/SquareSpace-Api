<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Request;
use Redirect;
class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // if( ! Request::secure())
        // {
        //     return Redirect::secure(Request::path());
        // }

        return $next($request);
    }
}
