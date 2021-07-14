<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ArtikelAccess
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
        if ($request->session()->get('role') == '1' || $request->session()->get('role') == '4'){
            return $next($request);
        }
        return redirect()->back();
    }
}
