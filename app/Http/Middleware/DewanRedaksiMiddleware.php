<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DewanRedaksiMiddleware
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
        if ($request->session()->get('role') != '6'){
            return redirect()->back();
        }
        return $next($request);
    }
}
