<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PendetaMiddleware
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
        if ($request->session()->get('role') != '3'){
            return redirect()->back();
        }
        return $next($request);
    }
}
