<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté et a le rôle "super-admin"
        if (!Auth::check() || Auth::user()->role !== 'super-admin') {
            abort(403, 'Accès non autorisé');
        }

        return $next($request);
    }
};
