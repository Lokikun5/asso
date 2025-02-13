<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {   
        // 🔴 Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/login')->with('error', '❌ Vous devez être connecté.');
        }

        // 🔴 Vérifie si l'utilisateur est "admin" ou "super-admin"
        if (!in_array(Auth::user()->role, ['admin', 'super-admin'])) {
            return redirect('/')->with('error', '❌ Accès refusé. Seuls les administrateurs peuvent accéder à cette page.');
        }

        // ✅ L'utilisateur est autorisé → Il peut continuer
        return $next($request);
    }
};