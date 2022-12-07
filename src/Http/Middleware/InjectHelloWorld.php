<?php

namespace AbbasShDev\BlogPackage\Http\Middleware;

use Closure;

class CapitalizeTitle
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Perform action

        return $response;
    }
}