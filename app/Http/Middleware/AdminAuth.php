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
            if(auth()->user()->status < '7'){
                return redirect()->route('getLogin')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้ !!');
            }
        }else{
            return redirect()->route('getLogin')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้ !!');
        }
        return $next($request);
    }
}
