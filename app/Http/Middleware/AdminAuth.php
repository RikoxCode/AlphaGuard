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
        if($request->user()->permissions_level >= 80 || $request->user()->is_sys_admin === 1){
            return $next($request);
        }
        return response()->json(['message' => 'Your permission level is not high enough!'], 401);
    }
}
