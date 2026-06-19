<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->role == 'user'){
            return redirect()->route('');
        }

        if (auth()->check() && auth()->user()->is_admin == 1) {
        return $next($request);
    }

    // Si pas admin, on renvoie une erreur 403 (Accès interdit)
    return response()->json(['message' => 'Accès refusé. Réservé aux administrateurs.'], 403);

        return $next($request);
    }
}
