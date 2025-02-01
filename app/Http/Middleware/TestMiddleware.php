<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
{
    public function handle($request, Closure $next)
    {
        die("Le middleware TestMiddleware fonctionne !");
        return $next($request);
    }
}
