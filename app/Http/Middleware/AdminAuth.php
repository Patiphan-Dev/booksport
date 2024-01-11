<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            if(auth()->user()->status != '9'){
                return redirect()->route('getLogin')->with('error', 'คุณไม่ใช่แอดมิน !!');
            }
        }else{
            return redirect()->route('getLogin')->with('error', 'คุณไม่ใช่แอดมิน !!');
        }
        return $next($request);
    }
}
