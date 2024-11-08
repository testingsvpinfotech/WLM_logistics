<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        if(($path != 'sign-in' && $path != 'register') && (!Session::get('customer')))
         {
             return redirect()->route('sign-in');
         }
         if(($path == 'sign-in' || $path == 'register') && (Session::get('customer')))
         {
            return redirect()->route('app.dashboard');
         }
        return $next($request);
    }
}
