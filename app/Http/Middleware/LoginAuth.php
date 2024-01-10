<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            if(!auth()->user()->username && !auth()->user()->password){
                return redirect()->route('getLogin')->with('error', 'คุณต้องเข้าสู่ระบบเพื่อเข้าถึงหน้านี้');
            }
        }else{
            return redirect()->route('getLogin')->with('error', 'คุณต้องเข้าสู่ระบบเพื่อเข้าถึงหน้านี้');
        }
        return $next($request);
    }
}
