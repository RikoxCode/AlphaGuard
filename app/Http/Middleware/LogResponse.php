<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LogController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Process the request and get the response
        $response = $next($request);

        // Log the response details
        $log = new LogController();
        $log->store($request, $response);

        // Return the response
        return $response;
    }
}
